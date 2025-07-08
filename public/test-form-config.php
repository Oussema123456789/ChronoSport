<?php
echo "<h2>Test de la Configuration des Formulaires</h2>";

echo "<h3>Liens de test :</h3>";
echo "<ul>";
echo "<li><a href='/admin/form-config/1/edit' target='_blank'>Configuration pour l'événement ID 1</a></li>";
echo "<li><a href='/admin/form-config/2/edit' target='_blank'>Configuration pour l'événement ID 2</a></li>";
echo "<li><a href='/admin/form-config/3/edit' target='_blank'>Configuration pour l'événement ID 3</a></li>";
echo "<li><a href='/admin/form-config/4/edit' target='_blank'>Configuration pour l'événement ID 4</a></li>";
echo "</ul>";

echo "<h3>Test de la page de configuration (sans auth) :</h3>";
echo "<ul>";
echo "<li><a href='/test-form-config/1/edit' target='_blank'>Page de test - Événement ID 1</a></li>";
echo "<li><a href='/test-form-config/2/edit' target='_blank'>Page de test - Événement ID 2</a></li>";
echo "</ul>";

echo "<h3>Test du formulaire d'inscription dynamique :</h3>";
echo "<ul>";
echo "<li><a href='/inscription-en-ligne/1/epreuve/1' target='_blank'>Formulaire d'inscription - Événement 1, Épreuve 1</a></li>";
echo "<li><a href='/inscription-en-ligne/2/epreuve/2' target='_blank'>Formulaire d'inscription - Événement 2, Épreuve 2</a></li>";
echo "</ul>";

echo "<hr>";
echo "<p><strong>Instructions :</strong></p>";
echo "<ol>";
echo "<li>Testez d'abord la configuration des formulaires</li>";
echo "<li>Modifiez quelques champs (activé/désactivé, obligatoire/optionnel)</li>";
echo "<li>Sauvegardez la configuration</li>";
echo "<li>Testez ensuite le formulaire d'inscription pour voir les changements</li>";
echo "</ol>";
?>
