<?php

/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 20/08/15
 * Time: 21:38
 */

namespace com\readysteadyrainbow\twig;

use Twig_Environment;
use Twig_Loader_Filesystem;
use Twig_SimpleFunction;

class Model{
    public $name;

    public function setName($name){
        $this->name = $name;
    }
}

class TwigView extends \Slim\View
{
    public $twig;
    public function render($template, $data = NULL){
        $loader = new Twig_Loader_Filesystem('templates');
        $this->twig = new Twig_Environment($loader);
        $this->twig->addGlobal('Model', new Model());
        $func = new Twig_SimpleFunction("BeginForm", function($controller, $action, $attributes){
            $m = $this->twig->getGlobals()["Model"]->name;
            echo "<form action='/" . $controller . "/" . $action . "' " . "enctype='multipart/form-data' method='post' " . ">";
            echo "<input type='hidden' name='Model' value='" . $m . "' >";
        });
        $this->twig->addFunction($func);

        echo $this->twig->render($template, array('model' => $this->data['model']));
    }

}