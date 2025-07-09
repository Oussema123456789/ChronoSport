<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Sponsor;
use App\Models\Event;

echo "<h2>Debug des Images</h2>";

$eventId = $_GET['event_id'] ?? 3;
echo "<p>Événement ID: <strong>{$eventId}</strong></p>";

// Récupérer les sponsors
$sponsors = Sponsor::where('evenement_id', $eventId)->get();
echo "<h3>🏢 Sponsors et leurs images :</h3>";

if ($sponsors->count() > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Chemin Image (DB)</th><th>Chemin Complet</th><th>Fichier Existe?</th><th>Aperçu</th></tr>";
    
    foreach ($sponsors as $sponsor) {
        $imagePath = $sponsor->image;
        $fullPath = storage_path('app/public/' . $imagePath);
        $publicPath = asset('storage/' . $imagePath);
        $fileExists = file_exists($fullPath) ? '✅' : '❌';
        
        echo "<tr>";
        echo "<td>{$sponsor->id}</td>";
        echo "<td>{$sponsor->nom}</td>";
        echo "<td>{$imagePath}</td>";
        echo "<td>{$publicPath}</td>";
        echo "<td>{$fileExists}</td>";
        echo "<td>";
        if (file_exists($fullPath)) {
            echo "<img src='{$publicPath}' style='max-width: 100px; max-height: 50px;' alt='{$sponsor->nom}'>";
        } else {
            echo "Image non trouvée";
        }
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Aucun sponsor trouvé pour cet événement.</p>";
}

echo "<hr>";
echo "<h3>Vérification du dossier storage :</h3>";
$storagePath = storage_path('app/public');
echo "<p><strong>Dossier storage/app/public :</strong> {$storagePath}</p>";
echo "<p><strong>Dossier existe :</strong> " . (is_dir($storagePath) ? '✅' : '❌') . "</p>";

if (is_dir($storagePath)) {
    $files = scandir($storagePath);
    echo "<p><strong>Contenu du dossier :</strong></p>";
    echo "<ul>";
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "<li>{$file}</li>";
        }
    }
    echo "</ul>";
}

echo "<hr>";
echo "<h3>Vérification du lien symbolique :</h3>";
$publicStoragePath = public_path('storage');
echo "<p><strong>Dossier public/storage :</strong> {$publicStoragePath}</p>";
echo "<p><strong>Lien existe :</strong> " . (is_link($publicStoragePath) || is_dir($publicStoragePath) ? '✅' : '❌') . "</p>";

echo "<hr>";
echo "<h3>Test d'autres événements :</h3>";
$events = Event::all();
foreach ($events as $evt) {
    $sponsorCount = Sponsor::where('evenement_id', $evt->id)->count();
    echo "<a href='?event_id={$evt->id}' style='margin-right: 10px;'>{$evt->nom} ({$sponsorCount} sponsors)</a>";
}
?>
