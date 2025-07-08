<?php
echo "<h2>Test des Extensions PHP</h2>";

echo "<h3>Extension GD :</h3>";
if (extension_loaded('gd')) {
    echo "✅ <strong style='color: green;'>GD est activée</strong><br>";
    $gd_info = gd_info();
    echo "Version GD : " . $gd_info['GD Version'] . "<br>";
} else {
    echo "❌ <strong style='color: red;'>GD n'est PAS activée</strong><br>";
}

echo "<h3>Extension Imagick :</h3>";
if (extension_loaded('imagick')) {
    echo "✅ <strong style='color: green;'>Imagick est activée</strong><br>";
} else {
    echo "❌ <strong style='color: red;'>Imagick n'est PAS activée</strong><br>";
}

echo "<h3>Toutes les extensions chargées :</h3>";
$extensions = get_loaded_extensions();
sort($extensions);
foreach ($extensions as $ext) {
    echo $ext . "<br>";
}

echo "<hr>";
echo "<p><strong>Fichier php.ini utilisé :</strong> " . php_ini_loaded_file() . "</p>";
?>
