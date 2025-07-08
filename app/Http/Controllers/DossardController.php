<?php

namespace App\Http\Controllers;

use App\Models\Epreuve;
use App\Models\Inscription;
use App\Models\Event;
use Illuminate\Http\Request;

class DossardController extends Controller
{
    /**
     * Obtient le driver d'image approprié
     */
    private function getImageDriver()
    {
        try {
            // Essayer d'abord Imagick, puis GD
            if (extension_loaded('imagick')) {
                \Log::info('Utilisation du driver Imagick');
                return new ImagickDriver();
            } elseif (extension_loaded('gd')) {
                \Log::info('Utilisation du driver GD');
                return new Driver();
            } else {
                \Log::warning('Aucune extension d\'image disponible');
                return null;
            }
        } catch (\Exception $e) {
            \Log::error('Erreur lors de la création du driver: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Crée une image simple avec du texte (fallback sans extensions d'image)
     */
    private function createSimpleImage($backgroundPath, $text, $x, $y, $fontSize, $color)
    {
        // Créer le dossier de destination s'il n'existe pas
        $storageDir = storage_path('app/public');
        if (!file_exists($storageDir)) {
            mkdir($storageDir, 0755, true);
        }

        // Pour l'instant, on copie juste l'image de fond
        // Dans un environnement de production, vous devriez installer GD ou Imagick
        $outputPath = storage_path('app/public/temp_dossard_' . time() . '.png');

        if (copy($backgroundPath, $outputPath)) {
            return $outputPath;
        } else {
            throw new \Exception('Impossible de copier l\'image de fond.');
        }
    }

    /**
     * Affiche la page de conception des dossards
     */
    public function index()
    {
        $events = Event::with('epreuves')->get();
        return view('admin.dossard.index', compact('events'));
    }

    /**
     * Affiche le formulaire de conception pour une épreuve spécifique
     */
    public function create(Request $request)
    {
        $epreuve_id = $request->get('epreuve_id');
        $epreuve = null;
        $inscriptions = collect();

        if ($epreuve_id) {
            $epreuve = Epreuve::with(['evenement', 'inscriptions'])->findOrFail($epreuve_id);
            $inscriptions = $epreuve->inscriptions;
        }

        $events = Event::with('epreuves')->get();
        return view('admin.dossard.create', compact('events', 'epreuve', 'inscriptions'));
    }

    /**
     * Génère tous les dossards pour une épreuve (sans ZIP)
     */
    public function generate(Request $request)
    {
        try {
            // Vérifier que GD est disponible
            if (!extension_loaded('gd')) {
                return back()->with('error', 'L\'extension GD n\'est pas activée. Veuillez l\'activer dans Laragon.');
            }

            $request->validate([
                'background' => 'required|image|mimes:jpeg,png',
                'epreuve_id' => 'required|exists:epreuves,id',
                'font_size' => 'required|integer',
                'position_x' => 'required|integer',
                'position_y' => 'required|integer',
                'color' => 'required|string',
            ]);

            $inscriptions = Inscription::where('epreuve_id', $request->epreuve_id)->get();

            if ($inscriptions->isEmpty()) {
                return back()->with('error', 'Aucune inscription trouvée pour cette épreuve.');
            }

            $backgroundPath = $request->file('background')->getPathname();
            $epreuve = Epreuve::findOrFail($request->epreuve_id);

            // Créer un dossier pour stocker tous les dossards
            $folderName = "dossards_epreuve_{$epreuve->id}_" . date('Y-m-d_H-i-s');
            $folderPath = storage_path("app/public/{$folderName}");

            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0755, true);
            }

            $generatedCount = 0;
            $generatedFiles = [];

            foreach ($inscriptions as $inscription) {
                try {
                    $dossardPath = $this->generateSingleDossardForFolder(
                        $backgroundPath,
                        $inscription,
                        $request->font_size,
                        $request->position_x,
                        $request->position_y,
                        $request->color,
                        $request->has('with_name'),
                        $folderPath
                    );

                    if ($dossardPath && file_exists($dossardPath)) {
                        $generatedFiles[] = $dossardPath;
                        $generatedCount++;
                    }
                } catch (\Exception $e) {
                    \Log::error("Erreur génération dossard pour inscription {$inscription->id}: " . $e->getMessage());
                }
            }

            if ($generatedCount === 0) {
                return back()->with('error', 'Aucun dossard n\'a pu être généré.');
            }

            // Créer un fichier TAR (alternative au ZIP) ou retourner le premier dossard avec un message
            if ($generatedCount === 1) {
                // Si un seul dossard, le télécharger directement
                $filename = basename($generatedFiles[0]);
                return response()->download($generatedFiles[0], $filename)->deleteFileAfterSend(true);
            } else {
                // Plusieurs dossards : rediriger vers une page de téléchargement
                return redirect()->route('admin.dossards.download.list', [
                    'folder' => $folderName,
                    'count' => $generatedCount,
                    'epreuve' => $epreuve->id
                ])->with('success', "{$generatedCount} dossards générés avec succès !");
            }

        } catch (\Exception $e) {
            \Log::error('Erreur génération dossards: ' . $e->getMessage());
            return back()->with('error', 'Erreur lors de la génération: ' . $e->getMessage());
        }
    }



    /**
     * Convertit une couleur hex en RGB
     */
    private function hexToRgb($hex)
    {
        $hex = str_replace('#', '', $hex);

        if (strlen($hex) == 3) {
            $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
        }

        return [
            'r' => hexdec(substr($hex, 0, 2)),
            'g' => hexdec(substr($hex, 2, 2)),
            'b' => hexdec(substr($hex, 4, 2))
        ];
    }

    /**
     * Génère un dossard individuel dans un dossier spécifique
     */
    private function generateSingleDossardForFolder($backgroundPath, $inscription, $fontSize, $positionX, $positionY, $color, $withName = false, $folderPath)
    {
        // Créer une image à partir du fichier uploadé
        $imageInfo = getimagesize($backgroundPath);
        $imageType = $imageInfo[2];

        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($backgroundPath);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($backgroundPath);
                break;
            default:
                throw new \Exception('Format d\'image non supporté');
        }

        if (!$image) {
            throw new \Exception('Impossible de charger l\'image');
        }

        // Convertir la couleur hex en RGB
        $colorRGB = $this->hexToRgb($color);
        $textColor = imagecolorallocate($image, $colorRGB['r'], $colorRGB['g'], $colorRGB['b']);

        // Ajouter le numéro de dossard
        $text = (string) $inscription->dossard;

        // Utiliser une police système ou TTF si disponible
        $fontPath = public_path('fonts/poppins/Poppins-Bold.ttf');
        if (file_exists($fontPath)) {
            // Utiliser TTF
            imagettftext($image, $fontSize, 0, $positionX, $positionY, $textColor, $fontPath, $text);
        } else {
            // Utiliser police système
            imagestring($image, 5, $positionX, $positionY, $text, $textColor);
        }

        // Ajouter le nom si demandé
        if ($withName) {
            $nameText = $inscription->prenom . ' ' . $inscription->nom;
            $nameFontSize = $fontSize * 0.6;
            $nameY = $positionY + $fontSize + 10;

            if (file_exists($fontPath)) {
                imagettftext($image, $nameFontSize, 0, $positionX, $nameY, $textColor, $fontPath, $nameText);
            } else {
                imagestring($image, 3, $positionX, $nameY, $nameText, $textColor);
            }
        }

        // Sauvegarder l'image dans le dossier spécifique
        $filename = "dossard_{$inscription->dossard}_{$inscription->nom}_{$inscription->prenom}.png";
        $filePath = $folderPath . '/' . $filename;

        imagepng($image, $filePath);
        imagedestroy($image);

        return $filePath;
    }

    /**
     * Affiche la liste des dossards générés pour téléchargement
     */
    public function downloadList(Request $request)
    {
        $folderName = $request->get('folder');
        $count = $request->get('count');
        $epreuveId = $request->get('epreuve');

        $folderPath = storage_path("app/public/{$folderName}");

        if (!file_exists($folderPath)) {
            return redirect()->route('admin.dossards.index')->with('error', 'Dossier de dossards introuvable.');
        }

        $files = glob($folderPath . '/*.png');
        $epreuve = Epreuve::with('evenement')->findOrFail($epreuveId);

        return view('admin.dossard.download-list', compact('files', 'folderName', 'count', 'epreuve'));
    }

    /**
     * Télécharge un dossard individuel
     */
    public function downloadSingle(Request $request)
    {
        $folderName = $request->get('folder');
        $filename = $request->get('file');

        $filePath = storage_path("app/public/{$folderName}/{$filename}");

        if (!file_exists($filePath)) {
            return back()->with('error', 'Fichier introuvable.');
        }

        return response()->download($filePath);
    }

}
