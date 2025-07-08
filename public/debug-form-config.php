<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\FormConfiguration;
use App\Models\Event;

echo "<h2>Debug Configuration des Formulaires</h2>";

// Afficher tous les événements
$events = Event::all();
echo "<h3>Événements disponibles :</h3>";
echo "<ul>";
foreach ($events as $event) {
    echo "<li>ID: {$event->id} - {$event->nom}</li>";
}
echo "</ul>";

// Afficher les configurations existantes
$configs = FormConfiguration::all();
echo "<h3>Configurations existantes :</h3>";
if ($configs->count() > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>ID</th><th>Event ID</th><th>Configuration</th><th>Créé le</th></tr>";
    foreach ($configs as $config) {
        echo "<tr>";
        echo "<td>{$config->id}</td>";
        echo "<td>{$config->event_id}</td>";
        echo "<td><pre>" . json_encode($config->field_config, JSON_PRETTY_PRINT) . "</pre></td>";
        echo "<td>{$config->created_at}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Aucune configuration trouvée.</p>";
}

// Test de récupération de configuration pour un événement
echo "<h3>Test de récupération pour l'événement ID 1 :</h3>";
$config1 = FormConfiguration::getConfigForEvent(1);
echo "<pre>" . json_encode($config1, JSON_PRETTY_PRINT) . "</pre>";
?>
