<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Sponsor;
use App\Models\Event;

echo "<h2>Correction des Chemins d'Images</h2>";

// Vérifier et corriger les sponsors
echo "<h3>Vérification des sponsors :</h3>";
$sponsors = Sponsor::all();

foreach ($sponsors as $sponsor) {
    $imagePath = $sponsor->image;
    $fullPath = storage_path('app/public/' . $imagePath);
    
    echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px 0;'>";
    echo "<h4>Sponsor: {$sponsor->nom}</h4>";
    echo "<p><strong>Chemin DB:</strong> {$imagePath}</p>";
    echo "<p><strong>Chemin complet:</strong> {$fullPath}</p>";
    
    if (file_exists($fullPath)) {
        echo "<p>✅ <strong>Fichier existe</strong></p>";
        echo "<p><strong>URL publique:</strong> " . asset('storage/' . $imagePath) . "</p>";
        echo "<img src='" . asset('storage/' . $imagePath) . "' style='max-width: 150px; max-height: 75px; border: 1px solid #ccc;' alt='{$sponsor->nom}'>";
    } else {
        echo "<p>❌ <strong>Fichier manquant</strong></p>";
        
        // Essayer de trouver le fichier dans d'autres emplacements
        $possiblePaths = [
            public_path($imagePath),
            public_path('storage/' . $imagePath),
            public_path('images/' . basename($imagePath)),
            storage_path('app/' . $imagePath),
        ];
        
        $found = false;
        foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
                echo "<p>🔍 <strong>Trouvé dans:</strong> {$path}</p>";
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            echo "<p>🔍 <strong>Fichier introuvable partout</strong></p>";
        }
    }
    echo "</div>";
}

// Vérifier et corriger les événements
echo "<h3>Vérification des événements :</h3>";
$events = Event::all();

foreach ($events as $event) {
    echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px 0;'>";
    echo "<h4>Événement: {$event->nom}</h4>";
    
    // Image de couverture
    if ($event->image_couverture) {
        $imagePath = $event->image_couverture;
        $fullPath = storage_path('app/public/' . $imagePath);
        
        echo "<p><strong>Image de couverture:</strong> {$imagePath}</p>";
        if (file_exists($fullPath)) {
            echo "<p>✅ <strong>Couverture existe</strong></p>";
            echo "<img src='" . asset('storage/' . $imagePath) . "' style='max-width: 200px; max-height: 100px; border: 1px solid #ccc;' alt='Couverture {$event->nom}'>";
        } else {
            echo "<p>❌ <strong>Couverture manquante</strong></p>";
        }
    } else {
        echo "<p>ℹ️ <strong>Pas d'image de couverture</strong></p>";
    }
    
    // Image de profil
    if ($event->image_profile) {
        $imagePath = $event->image_profile;
        $fullPath = storage_path('app/public/' . $imagePath);
        
        echo "<p><strong>Image de profil:</strong> {$imagePath}</p>";
        if (file_exists($fullPath)) {
            echo "<p>✅ <strong>Profil existe</strong></p>";
            echo "<img src='" . asset('storage/' . $imagePath) . "' style='max-width: 100px; max-height: 100px; border: 1px solid #ccc; border-radius: 50%;' alt='Profil {$event->nom}'>";
        } else {
            echo "<p>❌ <strong>Profil manquant</strong></p>";
        }
    } else {
        echo "<p>ℹ️ <strong>Pas d'image de profil</strong></p>";
    }
    
    echo "</div>";
}

echo "<hr>";
echo "<h3>Actions disponibles :</h3>";
echo "<ul>";
echo "<li><a href='/create-test-images.php?event_id=3' target='_blank'>Créer des images de test pour l'événement 3</a></li>";
echo "<li><a href='/debug-images.php?event_id=3' target='_blank'>Debug détaillé des images</a></li>";
echo "<li><a href='/admin/template/3' target='_blank'>Voir le tableau de bord</a></li>";
echo "</ul>";

echo "<hr>";
echo "<h3>Informations système :</h3>";
echo "<p><strong>Extension GD:</strong> " . (extension_loaded('gd') ? '✅ Activée' : '❌ Désactivée') . "</p>";
echo "<p><strong>Dossier storage/app/public:</strong> " . (is_dir(storage_path('app/public')) ? '✅ Existe' : '❌ Manquant') . "</p>";
echo "<p><strong>Lien public/storage:</strong> " . (is_link(public_path('storage')) || is_dir(public_path('storage')) ? '✅ Existe' : '❌ Manquant') . "</p>";
?>
