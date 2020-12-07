<?php

use \DateTime;
use Twig\Extension\DebugExtension;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

// activation du système d'autoloading de Composer
require __DIR__.'/vendor/autoload.php';

// instanciation du chargeur de templates
$loader = new FilesystemLoader(__DIR__.'/templates');

// instanciation du moteur de template
$twig = new Environment($loader, [
    'debug' => true,
    
    'strict_variables' => true,
]);

// initialisation d'une donnée
var_dump($_POST);

$errors = [];

if ($_POST) {

    if (empty($_POST['mail'])) {
        $errors['mail'] = 'merci de renseigner ce champ';
    } elseif (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL) == false) {
        $errors['mail'] = 'merci de renseigner un email valide';
    }

}

// affichage du rendu d'un template
echo $twig->render('hello-twig.html.twig', [
    // transmission de données au template
    'errors' =>$errors,
]);