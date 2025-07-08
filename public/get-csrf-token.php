<?php
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "<h2>Token CSRF</h2>";
echo "<p>Token: <strong>" . csrf_token() . "</strong></p>";
echo "<p>Copiez ce token et utilisez-le dans vos tests.</p>";

echo "<h3>Test de la page de configuration :</h3>";
echo "<p><a href='/admin/form-config/1/edit' target='_blank'>Configuration pour l'événement ID 1</a></p>";
?>
