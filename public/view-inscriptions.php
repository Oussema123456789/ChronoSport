<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Inscription;

echo "<h2>Inscriptions dans la Base de Données</h2>";

$inscriptions = Inscription::with('epreuve.evenement')->orderBy('created_at', 'desc')->take(10)->get();

if ($inscriptions->count() > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>Dossard</th>";
    echo "<th>Nom</th>";
    echo "<th>Prénom</th>";
    echo "<th>Email</th>";
    echo "<th>Téléphone</th>";
    echo "<th>CIN</th>";
    echo "<th>Genre</th>";
    echo "<th>Nationalité</th>";
    echo "<th>Club</th>";
    echo "<th>Date Naissance</th>";
    echo "<th>Épreuve</th>";
    echo "<th>Événement</th>";
    echo "<th>Créé le</th>";
    echo "</tr>";
    
    foreach ($inscriptions as $inscription) {
        echo "<tr>";
        echo "<td>{$inscription->id}</td>";
        echo "<td>{$inscription->dossard}</td>";
        echo "<td>" . ($inscription->nom ?? '<em>NULL</em>') . "</td>";
        echo "<td>" . ($inscription->prenom ?? '<em>NULL</em>') . "</td>";
        echo "<td>" . ($inscription->email ?? '<em>NULL</em>') . "</td>";
        echo "<td>" . ($inscription->telephone ?? '<em>NULL</em>') . "</td>";
        echo "<td>" . ($inscription->cin ?? '<em>NULL</em>') . "</td>";
        echo "<td>" . ($inscription->genre ?? '<em>NULL</em>') . "</td>";
        echo "<td>" . ($inscription->nationalite ?? '<em>NULL</em>') . "</td>";
        echo "<td>" . ($inscription->club ?? '<em>NULL</em>') . "</td>";
        echo "<td>" . ($inscription->date_naissance ?? '<em>NULL</em>') . "</td>";
        echo "<td>" . ($inscription->epreuve->nom ?? 'N/A') . "</td>";
        echo "<td>" . ($inscription->epreuve->evenement->nom ?? 'N/A') . "</td>";
        echo "<td>{$inscription->created_at}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>Aucune inscription trouvée.</p>";
}

echo "<hr>";
echo "<p><a href='/test-inscription-config.php'>Retour aux tests</a></p>";
?>
