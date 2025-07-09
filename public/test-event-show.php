<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Event;

echo "<h2>Test de la Page d'Affichage d'Événement</h2>";

// Récupérer tous les événements
$events = Event::with(['epreuves.inscriptions', 'sponsors'])->get();

echo "<h3>Événements disponibles pour test :</h3>";
echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>ID</th><th>Nom</th><th>Date</th><th>Épreuves</th><th>Sponsors</th><th>Inscriptions</th><th>Actions</th></tr>";

foreach ($events as $event) {
    $totalInscriptions = $event->epreuves->sum(function($epreuve) {
        return $epreuve->inscriptions->count();
    });
    
    echo "<tr>";
    echo "<td>{$event->id}</td>";
    echo "<td><strong>{$event->nom}</strong></td>";
    echo "<td>" . \Carbon\Carbon::parse($event->date)->format('d/m/Y') . "</td>";
    echo "<td>{$event->epreuves->count()}</td>";
    echo "<td>{$event->sponsors->count()}</td>";
    echo "<td>{$totalInscriptions}</td>";
    echo "<td>";
    echo "<a href='/admin/event/show/{$event->id}' target='_blank' class='btn btn-primary' style='margin-right: 5px; padding: 5px 10px; background: #007bff; color: white; text-decoration: none; border-radius: 3px;'>Voir la page</a>";
    echo "<a href='/inscription-en-ligne/{$event->id}/epreuves' target='_blank' class='btn btn-success' style='padding: 5px 10px; background: #28a745; color: white; text-decoration: none; border-radius: 3px;'>Page inscription</a>";
    echo "</td>";
    echo "</tr>";
}

echo "</table>";

echo "<hr>";
echo "<h3>Fonctionnalités de la page :</h3>";
echo "<ul>";
echo "<li>✅ <strong>Hero Section</strong> : Titre, date et bouton d'inscription principal</li>";
echo "<li>✅ <strong>Informations détaillées</strong> : Date, lieu, type, contact</li>";
echo "<li>✅ <strong>Description de l'événement</strong> : Contenu complet avec règlement</li>";
echo "<li>✅ <strong>Contact organisateur</strong> : Email, téléphone, site web</li>";
echo "<li>✅ <strong>Image de l'événement</strong> : Affichage dans la sidebar</li>";
echo "<li>✅ <strong>Bouton d'inscription</strong> : Lien vers la page d'inscription</li>";
echo "<li>✅ <strong>Design responsive</strong> : Adapté mobile et desktop</li>";
echo "<li>✅ <strong>Section sponsors</strong> : Défilement automatique en bas</li>";
echo "</ul>";

echo "<hr>";
echo "<h3>Sections supprimées (sur demande) :</h3>";
echo "<ul>";
echo "<li>❌ <strong>Section 'Rejoignez-nous !'</strong> : Titre et statistiques dans la sidebar</li>";
echo "<li>❌ <strong>Section 'Épreuves disponibles'</strong> : Liste détaillée des épreuves</li>";
echo "<li>ℹ️ <strong>Note</strong> : L'inscription se fait via le bouton principal dans le hero</li>";
echo "</ul>";

echo "<hr>";
echo "<h3>Liens d'inscription générés :</h3>";
echo "<ul>";
foreach ($events->take(3) as $event) {
    echo "<li><strong>{$event->nom}</strong> :</li>";
    echo "<ul>";
    echo "<li>Toutes les épreuves : <code>/inscription-en-ligne/{$event->id}/epreuves</code></li>";
    foreach ($event->epreuves->take(2) as $epreuve) {
        echo "<li>Épreuve '{$epreuve->nom}' : <code>/inscription-en-ligne/{$event->id}/epreuve/{$epreuve->id}</code></li>";
    }
    echo "</ul>";
}
echo "</ul>";

echo "<hr>";
echo "<h3>Test recommandé :</h3>";
echo "<ol>";
echo "<li><strong>Ouvrez</strong> une page d'événement ci-dessus</li>";
echo "<li><strong>Vérifiez</strong> l'affichage des informations</li>";
echo "<li><strong>Testez</strong> les boutons d'inscription</li>";
echo "<li><strong>Vérifiez</strong> la responsivité sur mobile</li>";
echo "<li><strong>Testez</strong> les animations hover</li>";
echo "</ol>";

echo "<hr>";
echo "<h3>Événements recommandés pour test :</h3>";
$recommendedEvents = $events->filter(function($event) {
    return $event->epreuves->count() > 0 && $event->sponsors->count() > 0;
})->take(3);

if ($recommendedEvents->count() > 0) {
    foreach ($recommendedEvents as $event) {
        echo "<div style='border: 1px solid #ddd; padding: 15px; margin: 10px 0; border-radius: 5px;'>";
        echo "<h4>{$event->nom}</h4>";
        echo "<p><strong>Date :</strong> " . \Carbon\Carbon::parse($event->date)->format('d/m/Y') . "</p>";
        echo "<p><strong>Épreuves :</strong> {$event->epreuves->count()} | <strong>Sponsors :</strong> {$event->sponsors->count()}</p>";
        echo "<a href='/admin/event/show/{$event->id}' target='_blank' style='background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-right: 10px;'>Voir la page</a>";
        echo "<a href='/inscription-en-ligne/{$event->id}/epreuves' target='_blank' style='background: #28a745; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>S'inscrire</a>";
        echo "</div>";
    }
} else {
    echo "<p>Aucun événement avec épreuves et sponsors trouvé.</p>";
}
?>
