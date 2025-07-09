<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "<h2>Test de la Fonctionnalité de Déconnexion</h2>";

echo "<h3>Pages à tester :</h3>";
echo "<p>Connectez-vous d'abord, puis testez la déconnexion sur chaque page :</p>";

$testPages = [
    'Admin - Accueil' => '/admin/home',
    'Admin - Template Événement' => '/admin/template/3',
    'Admin - Événements' => '/admin/events',
    'Admin - Épreuves' => '/admin/events/3/epreuves',
    'Admin - Sponsors' => '/admin/events/3/sponsors',
    'Admin - Dossards' => '/admin/dossards',
    'Admin - Configuration Formulaire' => '/admin/form-config/3/edit',
    'Arbitre - Accueil' => '/arbitre/home',
    'Organisateur - Accueil' => '/organisateur/home',
];

echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
echo "<tr><th>Page</th><th>URL</th><th>Action</th></tr>";

foreach ($testPages as $pageName => $url) {
    echo "<tr>";
    echo "<td><strong>{$pageName}</strong></td>";
    echo "<td>{$url}</td>";
    echo "<td><a href='{$url}' target='_blank' style='margin-right: 10px;'>Ouvrir</a></td>";
    echo "</tr>";
}

echo "</table>";

echo "<hr>";
echo "<h3>Instructions de test :</h3>";
echo "<ol>";
echo "<li><strong>Connectez-vous</strong> d'abord : <a href='/login' target='_blank'>Page de connexion</a></li>";
echo "<li><strong>Ouvrez</strong> chaque page dans un nouvel onglet</li>";
echo "<li><strong>Cliquez</strong> sur votre nom d'utilisateur en haut à droite</li>";
echo "<li><strong>Cliquez</strong> sur 'Logout' dans le menu déroulant</li>";
echo "<li><strong>Vérifiez</strong> que vous êtes bien déconnecté et redirigé</li>";
echo "</ol>";

echo "<hr>";
echo "<h3>Problèmes potentiels et solutions :</h3>";
echo "<ul>";
echo "<li><strong>Bouton ne fait rien :</strong> Le JavaScript 'href=\"javascript:;\"' a été remplacé par un formulaire POST</li>";
echo "<li><strong>Erreur 419 :</strong> Token CSRF manquant - Ajouté @csrf dans tous les formulaires</li>";
echo "<li><strong>Erreur 405 :</strong> Méthode GET au lieu de POST - Corrigé avec method=\"POST\"</li>";
echo "<li><strong>Redirection incorrecte :</strong> Vérifiez la configuration dans LoginController</li>";
echo "</ul>";

echo "<hr>";
echo "<h3>Vérification des routes :</h3>";
try {
    $logoutRoute = route('logout');
    echo "<p>✅ <strong>Route logout :</strong> {$logoutRoute}</p>";
} catch (Exception $e) {
    echo "<p>❌ <strong>Erreur route logout :</strong> {$e->getMessage()}</p>";
}

try {
    $loginRoute = route('login');
    echo "<p>✅ <strong>Route login :</strong> {$loginRoute}</p>";
} catch (Exception $e) {
    echo "<p>❌ <strong>Erreur route login :</strong> {$e->getMessage()}</p>";
}

echo "<hr>";
echo "<h3>Templates corrigés :</h3>";
echo "<ul>";
echo "<li>✅ <strong>admin/template.blade.php</strong> - Formulaire POST avec @csrf</li>";
echo "<li>✅ <strong>arbitre/template.blade.php</strong> - Formulaire POST avec @csrf</li>";
echo "<li>✅ <strong>admin/home1.blade.php</strong> - Déjà correct</li>";
echo "<li>✅ <strong>organisateur/template.blade.php</strong> - Déjà correct</li>";
echo "<li>✅ <strong>admin/home.blade.php</strong> - Déjà correct</li>";
echo "</ul>";

echo "<hr>";
echo "<h3>Code de déconnexion utilisé :</h3>";
echo "<pre>";
echo htmlspecialchars('
<li>
    <form action="{{ route(\'logout\') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="dropdown-item" style="border: none; background: none; width: 100%; text-align: left;">
            <i class=\'bx bx-log-out-circle\'></i><span>Logout</span>
        </button>
    </form>
</li>
');
echo "</pre>";
?>
