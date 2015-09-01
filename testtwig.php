<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 20/08/15
 * Time: 21:26
 */

// Require the Composer autoloader.
require __DIR__ . '/vendor/autoload.php';


$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);

echo $twig->render('UploadAnimation.twig', array('name' => 'Fabien'));