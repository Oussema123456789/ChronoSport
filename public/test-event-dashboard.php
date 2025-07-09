<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Event;

echo "<h2>Test du Tableau de Bord des Événements</h2>";

// Afficher tous les événements disponibles
$events = Event::all();
echo "<h3>Événements disponibles :</h3>";
echo "<ul>";
foreach ($events as $event) {
    echo "<li>";
    echo "<strong>{$event->nom}</strong> - {$event->ville} ({$event->date})";
    echo "<br>";
    echo "<a href='/admin/template/{$event->id}' target='_blank' class='btn btn-primary'>Voir le Tableau de Bord</a>";
    echo "</li><br>";
}
echo "</ul>";

echo "<hr>";
echo "<h3>Fonctionnalités du Tableau de Bord :</h3>";
echo "<ul>";
echo "<li>📊 <strong>Statistiques</strong> : Nombre d'épreuves, inscriptions, sponsors, arbitres</li>";
echo "<li>📋 <strong>Liste des épreuves</strong> avec nombre d'inscriptions par épreuve</li>";
echo "<li>🏢 <strong>Sponsors</strong> avec leurs logos</li>";
echo "<li>⚡ <strong>Actions rapides</strong> : Ajouter épreuve, configurer formulaire, générer dossards</li>";
echo "<li>📱 <strong>Menu optimisé</strong> : Navigation contextuelle pour l'événement sélectionné</li>";
echo "</ul>";

echo "<hr>";
echo "<h3>Navigation optimisée :</h3>";
echo "<ul>";
echo "<li>🏠 <strong>Tableau de Bord</strong> : Vue d'ensemble de l'événement</li>";
echo "<li>🏃 <strong>Épreuves</strong> : Gestion des épreuves de l'événement</li>";
echo "<li>🏢 <strong>Sponsors</strong> : Gestion des sponsors de l'événement</li>";
echo "<li>⚙️ <strong>Configuration Formulaire</strong> : Personnalisation des champs d'inscription</li>";
echo "<li>🎫 <strong>Dossards</strong> : Génération des dossards pour l'événement</li>";
echo "</ul>";

echo "<hr>";
echo "<h3>Debug et Tests :</h3>";
echo "<ul>";
echo "<li><a href='/debug-event-data.php?event_id=3' target='_blank'>Debug des données - Événement 3</a></li>";
echo "<li><a href='/debug-event-data.php?event_id=1' target='_blank'>Debug des données - Événement 1</a></li>";
echo "<li><a href='/debug-images.php?event_id=3' target='_blank'>Debug des images - Événement 3</a></li>";
echo "<li><a href='/fix-image-paths.php' target='_blank'>Vérifier et corriger les chemins d'images</a></li>";
echo "<li><a href='/create-test-images.php?event_id=3' target='_blank'>Créer des images de test</a></li>";
echo "<li><a href='/test-sponsors/3' target='_blank'>Test d'affichage des sponsors - Événement 3</a></li>";
echo "<li><a href='/test-image-display.php' target='_blank'>Test direct des images</a></li>";
echo "<li><a href='/test-event-show.php' target='_blank'>Test de la page d'affichage d'événement améliorée</a></li>";
echo "<li><a href='/test-inscription-config.php'>Tests de configuration</a></li>";
echo "</ul>";
?>
