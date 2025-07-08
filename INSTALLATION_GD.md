# Installation de l'extension GD pour PHP

## Problème
L'erreur `Target [Intervention\Image\Interfaces\ImageManagerInterface] is not instantiable` indique que l'extension GD n'est pas activée dans PHP.

## Solution

### 1. Localiser le fichier php.ini
Le fichier se trouve à : `D:\xammp\php\php.ini`

### 2. Activer l'extension GD
1. Ouvrez le fichier `php.ini` avec un éditeur de texte (en tant qu'administrateur)
2. Recherchez la ligne : `;extension=gd`
3. Supprimez le point-virgule (`;`) au début de la ligne pour la décommenter :
   ```
   extension=gd
   ```

### 3. Redémarrer le serveur
1. Arrêtez XAMPP
2. Redémarrez XAMPP
3. Vérifiez que GD est activé avec : `php -m | findstr gd`

### 4. Alternative : Vérifier dans phpinfo()
Créez un fichier `test.php` avec :
```php
<?php phpinfo(); ?>
```
Et recherchez "GD" dans la page.

## Vérification
Une fois GD activé, la fonctionnalité de génération de dossards fonctionnera correctement avec :
- Ajout de texte sur les images
- Personnalisation de la police, taille, couleur
- Positionnement précis du numéro de dossard

## Extensions alternatives
Si GD ne fonctionne pas, vous pouvez aussi essayer d'activer Imagick :
```
extension=imagick
```
