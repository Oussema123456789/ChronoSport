<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Sponsor;

echo "<h2>Test d'Affichage des Images</h2>";

// Test direct d'une image existante
$sponsorImages = [
    'sponsors/1VmVq9aPfXuJpHwpnoi9TV3wFZA5i00LhhM3xrHz.png',
    'sponsors/3OFEAOlKFM5t6bJWLJr3GnqyO65KSZg0voQsCGw7.jpg',
    'sponsors/3Wj1cCdSdkRYYWijbNSjjJ1toKyIMdTwyhMdtEwv.png'
];

echo "<h3>Test d'images directes :</h3>";
foreach ($sponsorImages as $imagePath) {
    $fullPath = storage_path('app/public/' . $imagePath);
    $publicUrl = asset('storage/' . $imagePath);
    
    echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px 0;'>";
    echo "<p><strong>Chemin:</strong> {$imagePath}</p>";
    echo "<p><strong>URL publique:</strong> {$publicUrl}</p>";
    echo "<p><strong>Fichier existe:</strong> " . (file_exists($fullPath) ? '✅' : '❌') . "</p>";
    
    if (file_exists($fullPath)) {
        echo "<p><strong>Aperçu:</strong></p>";
        echo "<img src='{$publicUrl}' style='max-width: 200px; max-height: 100px; border: 1px solid #ccc;' alt='Test'>";
    }
    echo "</div>";
}

echo "<hr>";

// Test avec les sponsors de la base de données
echo "<h3>Test avec les sponsors de la base de données :</h3>";
$sponsors = Sponsor::take(5)->get();

foreach ($sponsors as $sponsor) {
    $imagePath = $sponsor->image;
    $fullPath = storage_path('app/public/' . $imagePath);
    $publicUrl = asset('storage/' . $imagePath);
    
    echo "<div style='border: 1px solid #ddd; padding: 10px; margin: 10px 0;'>";
    echo "<h4>Sponsor: {$sponsor->nom}</h4>";
    echo "<p><strong>Chemin DB:</strong> {$imagePath}</p>";
    echo "<p><strong>URL publique:</strong> {$publicUrl}</p>";
    echo "<p><strong>Fichier existe:</strong> " . (file_exists($fullPath) ? '✅' : '❌') . "</p>";
    
    if (file_exists($fullPath)) {
        echo "<p><strong>Aperçu:</strong></p>";
        echo "<img src='{$publicUrl}' style='max-width: 200px; max-height: 100px; border: 1px solid #ccc;' alt='{$sponsor->nom}'>";
    } else {
        echo "<p>❌ <strong>Image manquante</strong></p>";
    }
    echo "</div>";
}

echo "<hr>";
echo "<h3>Test du tableau de bord :</h3>";
echo "<p><a href='/admin/template/3' target='_blank'>Voir le tableau de bord - Événement 3</a></p>";
echo "<p><a href='/admin/template/1' target='_blank'>Voir le tableau de bord - Événement 1</a></p>";

echo "<hr>";
echo "<h3>Informations système :</h3>";
echo "<p><strong>URL de base:</strong> " . url('/') . "</p>";
echo "<p><strong>Asset URL:</strong> " . asset('storage/sponsors/test.png') . "</p>";
echo "<p><strong>Storage path:</strong> " . storage_path('app/public') . "</p>";
echo "<p><strong>Public storage path:</strong> " . public_path('storage') . "</p>";
?>
