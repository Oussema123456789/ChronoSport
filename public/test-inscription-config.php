<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\FormConfiguration;
use App\Models\Event;
use App\Models\Epreuve;

echo "<h2>Test Configuration et Inscription</h2>";

// Afficher les événements et épreuves disponibles
$events = Event::with('epreuves')->get();
echo "<h3>Événements et Épreuves disponibles :</h3>";
foreach ($events as $event) {
    echo "<h4>Événement: {$event->nom} (ID: {$event->id})</h4>";
    echo "<ul>";
    foreach ($event->epreuves as $epreuve) {
        echo "<li>Épreuve: {$epreuve->nom} (ID: {$epreuve->id})</li>";
        echo "<ul>";
        echo "<li><a href='/test-form-config/{$event->id}/edit' target='_blank'>Configurer le formulaire</a></li>";
        echo "<li><a href='/inscription-en-ligne/{$event->id}/epreuve/{$epreuve->id}' target='_blank'>Tester l'inscription</a></li>";
        echo "</ul>";
    }
    echo "</ul>";
}

// Afficher la configuration actuelle pour chaque événement
echo "<h3>Configuration actuelle des formulaires :</h3>";
foreach ($events as $event) {
    $config = FormConfiguration::getConfigForEvent($event->id);
    echo "<h4>Événement: {$event->nom}</h4>";
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>Champ</th><th>Activé</th><th>Obligatoire</th></tr>";
    foreach ($config as $fieldName => $fieldSettings) {
        $enabled = $fieldSettings['enabled'] ? '✅' : '❌';
        $required = $fieldSettings['required'] ? '✅' : '❌';
        echo "<tr><td>{$fieldName}</td><td>{$enabled}</td><td>{$required}</td></tr>";
    }
    echo "</table><br>";
}

echo "<hr>";
echo "<h3>Instructions de test :</h3>";
echo "<ol>";
echo "<li><strong>Configurez</strong> un formulaire en désactivant quelques champs</li>";
echo "<li><strong>Testez</strong> l'inscription pour voir si les champs désactivés n'apparaissent pas</li>";
echo "<li><strong>Vérifiez</strong> que l'inscription se fait sans erreur</li>";
echo "<li><strong>Consultez</strong> la base de données pour voir que les champs désactivés sont NULL</li>";
echo "</ol>";
?>
