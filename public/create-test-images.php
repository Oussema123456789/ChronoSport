<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Sponsor;
use App\Models\Event;

echo "<h2>Création d'Images de Test</h2>";

// Fonction pour créer une image de test
function createTestImage($text, $filename, $width = 200, $height = 100) {
    $storagePath = storage_path('app/public');
    if (!is_dir($storagePath)) {
        mkdir($storagePath, 0755, true);
    }
    
    $imagePath = $storagePath . '/' . $filename;
    
    // Créer une image simple avec GD
    if (extension_loaded('gd')) {
        $image = imagecreate($width, $height);
        
        // Couleurs
        $bg_color = imagecolorallocate($image, 240, 240, 240);
        $text_color = imagecolorallocate($image, 50, 50, 50);
        $border_color = imagecolorallocate($image, 200, 200, 200);
        
        // Bordure
        imagerectangle($image, 0, 0, $width-1, $height-1, $border_color);
        
        // Texte centré
        $font_size = 3;
        $text_width = imagefontwidth($font_size) * strlen($text);
        $text_height = imagefontheight($font_size);
        $x = ($width - $text_width) / 2;
        $y = ($height - $text_height) / 2;
        
        imagestring($image, $font_size, $x, $y, $text, $text_color);
        
        // Sauvegarder
        imagepng($image, $imagePath);
        imagedestroy($image);
        
        return true;
    }
    
    return false;
}

$eventId = $_GET['event_id'] ?? 3;
$event = Event::find($eventId);

if (!$event) {
    echo "<p>Événement non trouvé.</p>";
    exit;
}

echo "<h3>Création d'images pour l'événement : {$event->nom}</h3>";

// Créer des sponsors de test avec images
$testSponsors = [
    ['nom' => 'Sponsor Tech', 'filename' => 'sponsor_tech.png'],
    ['nom' => 'Sport Plus', 'filename' => 'sport_plus.png'],
    ['nom' => 'Energy Drink', 'filename' => 'energy_drink.png'],
    ['nom' => 'Running Gear', 'filename' => 'running_gear.png'],
];

echo "<h4>Création des images de sponsors :</h4>";
foreach ($testSponsors as $sponsorData) {
    $created = createTestImage($sponsorData['nom'], $sponsorData['filename']);
    
    if ($created) {
        echo "<p>✅ Image créée : {$sponsorData['filename']}</p>";
        
        // Vérifier si le sponsor existe déjà
        $existingSponsor = Sponsor::where('evenement_id', $eventId)
                                 ->where('nom', $sponsorData['nom'])
                                 ->first();
        
        if (!$existingSponsor) {
            Sponsor::create([
                'nom' => $sponsorData['nom'],
                'image' => $sponsorData['filename'],
                'evenement_id' => $eventId
            ]);
            echo "<p>✅ Sponsor ajouté : {$sponsorData['nom']}</p>";
        } else {
            echo "<p>ℹ️ Sponsor existe déjà : {$sponsorData['nom']}</p>";
        }
    } else {
        echo "<p>❌ Erreur création image : {$sponsorData['filename']}</p>";
    }
}

// Créer une image de couverture pour l'événement
echo "<h4>Création de l'image de couverture :</h4>";
$coverFilename = "event_cover_{$eventId}.png";
$created = createTestImage("Evenement: {$event->nom}", $coverFilename, 800, 300);

if ($created) {
    echo "<p>✅ Image de couverture créée : {$coverFilename}</p>";
    
    // Mettre à jour l'événement
    $event->update(['image_couverture' => $coverFilename]);
    echo "<p>✅ Événement mis à jour avec l'image de couverture</p>";
} else {
    echo "<p>❌ Erreur création image de couverture</p>";
}

// Créer une image de profil pour l'événement
echo "<h4>Création de l'image de profil :</h4>";
$profileFilename = "event_profile_{$eventId}.png";
$created = createTestImage(substr($event->nom, 0, 3), $profileFilename, 100, 100);

if ($created) {
    echo "<p>✅ Image de profil créée : {$profileFilename}</p>";
    
    // Mettre à jour l'événement
    $event->update(['image_profile' => $profileFilename]);
    echo "<p>✅ Événement mis à jour avec l'image de profil</p>";
} else {
    echo "<p>❌ Erreur création image de profil</p>";
}

echo "<hr>";
echo "<h3>Vérification :</h3>";
echo "<p><a href='/debug-images.php?event_id={$eventId}' target='_blank'>Vérifier les images</a></p>";
echo "<p><a href='/admin/template/{$eventId}' target='_blank'>Voir le tableau de bord</a></p>";

echo "<hr>";
echo "<h3>Autres événements :</h3>";
$events = Event::all();
foreach ($events as $evt) {
    echo "<a href='?event_id={$evt->id}' style='margin-right: 10px;'>{$evt->nom}</a>";
}
?>
