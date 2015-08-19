<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 18/08/15
 * Time: 21:17
 */
require __DIR__ . '/vendor/autoload.php';



$app = new \Slim\Slim();
$app->get('/books/:id', function ($id) use ($app){

//$app->render('output.php');
echo 'hi there';
});

$app->get('foo', function() use ($app){

});
// hello
$app->run();

