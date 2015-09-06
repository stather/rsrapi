<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 18/08/15
 * Time: 21:17
 */
require_once __DIR__ . '/configure.php';


use com\readysteadyrainbow\controllers\Controller;
use com\readysteadyrainbow\twig\TwigView;


$app = new \Slim\Slim(array(
    'view' => new TwigView()
));
$app->get('/', function() use ($app){
    Controller::Dispatch("Home", "home");
});


$app->post("/:controller/:action", function($controller, $action){
    Controller::Dispatch($controller, $action);
});


$app->get("/:controller/:action", function($controller, $action) {
    Controller::Dispatch($controller, $action);
});

$app->run();

