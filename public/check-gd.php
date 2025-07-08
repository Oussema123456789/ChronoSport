<?php
echo "<h2>Vérification GD dans le contexte Web</h2>";

echo "<h3>Extension GD :</h3>";
if (extension_loaded('gd')) {
    echo "✅ <strong style='color: green;'>GD est activée</strong><br>";
    $gd_info = gd_info();
    echo "<pre>";
    print_r($gd_info);
    echo "</pre>";
} else {
    echo "❌ <strong style='color: red;'>GD n'est PAS activée dans le contexte web</strong><br>";
}

echo "<h3>Toutes les extensions chargées :</h3>";
$extensions = get_loaded_extensions();
sort($extensions);
echo "<div style='columns: 3;'>";
foreach ($extensions as $ext) {
    if (stripos($ext, 'gd') !== false) {
        echo "<strong style='color: green;'>" . $ext . "</strong><br>";
    } else {
        echo $ext . "<br>";
    }
}
echo "</div>";

echo "<hr>";
echo "<p><strong>Fichier php.ini utilisé :</strong> " . php_ini_loaded_file() . "</p>";
echo "<p><strong>Version PHP :</strong> " . phpversion() . "</p>";
?>
