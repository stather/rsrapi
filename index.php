<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 18/08/15
 * Time: 21:17
 */
echo "a";
require __DIR__ . '/vendor/autoload.php';

define("RSR", "com\\readysteadyrainbow\\");

spl_autoload_register(function ($class) {
    if (substr_compare($class, RSR, 0, strlen(RSR)) == 0){
        $toks = explode("\\", $class);
        include $toks[2] . "/" . $toks[3] . ".php";
        return;
    }
    $start = strlen($class) - strlen("Controller");
    if (substr_compare($class, "Controller", $start ) == 0){
        include "controllers/" . $class . ".php";
        return;
    }
});


use com\readysteadyrainbow\controllers\Controller;
use \com\readysteadyrainbow\twig\TwigView;
use \Aws\S3\S3Client;
use \Aws\Credentials\Credentials;


date_default_timezone_set('UTC');

$credentials = new Credentials('AKIAJIYBZPTDIRPEDJRQ', 'vbJnztNWV1Aa/kqBax31EocVnv8ZvW0Q7ZYgzTtK');

// Instantiate an Amazon S3 client.
$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'us-east-1',
    'credentials' => $credentials
]);
\Aws\S3\StreamWrapper::register($s3);


$app = new \Slim\Slim(array(
    'view' => new TwigView()
));

$app->get('/', function() use ($app){
    Controller::Dispatch("home", "index");
});


$app->post("/:controller/:action", function($controller, $action){
    Controller::Dispatch($controller, $action);
});


$app->get("/:controller/:action", function($controller, $action) {
    Controller::Dispatch($controller, $action);
});

$app->run();

