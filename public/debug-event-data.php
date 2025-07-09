<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Event;
use App\Models\Epreuve;
use App\Models\Inscription;
use App\Models\Sponsor;

echo "<h2>Debug des Données d'Événement</h2>";

$eventId = $_GET['event_id'] ?? 3;
echo "<p>Événement ID: <strong>{$eventId}</strong></p>";

try {
    // Récupérer l'événement
    $event = Event::findOrFail($eventId);
    echo "<h3>✅ Événement trouvé :</h3>";
    echo "<p><strong>Nom :</strong> {$event->nom}</p>";
    echo "<p><strong>Date :</strong> {$event->date}</p>";
    echo "<p><strong>Ville :</strong> {$event->ville}</p>";

    // Récupérer les épreuves
    $epreuves = Epreuve::where('evenement_id', $eventId)->withCount('inscriptions')->get();
    echo "<h3>📊 Épreuves ({$epreuves->count()}) :</h3>";
    if ($epreuves->count() > 0) {
        echo "<ul>";
        foreach ($epreuves as $epreuve) {
            echo "<li><strong>{$epreuve->nom}</strong> - {$epreuve->inscriptions_count} inscriptions</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Aucune épreuve trouvée.</p>";
    }

    // Récupérer le total des inscriptions
    $totalInscriptions = Inscription::whereIn('epreuve_id', $epreuves->pluck('id'))->count();
    echo "<h3>👥 Total des inscriptions : {$totalInscriptions}</h3>";

    // Récupérer les sponsors
    $sponsors = Sponsor::where('evenement_id', $eventId)->get();
    echo "<h3>🏢 Sponsors ({$sponsors->count()}) :</h3>";
    if ($sponsors->count() > 0) {
        echo "<ul>";
        foreach ($sponsors as $sponsor) {
            echo "<li><strong>{$sponsor->nom}</strong></li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Aucun sponsor trouvé.</p>";
    }

    // Récupérer les arbitres
    $arbitres = $event->arbitres;
    echo "<h3>👨‍⚖️ Arbitres ({$arbitres->count()}) :</h3>";
    if ($arbitres->count() > 0) {
        echo "<ul>";
        foreach ($arbitres as $arbitre) {
            echo "<li><strong>{$arbitre->prenom} {$arbitre->nom}</strong> - {$arbitre->email}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Aucun arbitre assigné.</p>";
    }

} catch (Exception $e) {
    echo "<h3>❌ Erreur :</h3>";
    echo "<p>{$e->getMessage()}</p>";
}

echo "<hr>";
echo "<h3>Test d'autres événements :</h3>";
$events = Event::all();
foreach ($events as $evt) {
    echo "<a href='?event_id={$evt->id}' style='margin-right: 10px;'>{$evt->nom}</a>";
}

echo "<hr>";
echo "<p><a href='/admin/template/{$eventId}' target='_blank'>Voir le Tableau de Bord</a></p>";
?>
