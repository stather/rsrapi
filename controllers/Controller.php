<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 26/08/15
 * Time: 20:24
 */

namespace com\readysteadyrainbow\controllers;


class Controller
{


    public static function Dispatch($c, $a){
        global $app;
        $m = null;
        if (array_key_exists("Model", $_POST)){
            $modelName = $_POST["Model"];
            if (strlen($modelName) > 0){
                $model = "com\\readysteadyrainbow\\models\\" . $modelName;
                $m = new $model();
                foreach ($_FILES as $key => $value){
                    if (property_exists($m, $key)){
                        $m->$key = $value;
                    }
                }
                foreach ($_POST as $key => $value){
                    if (property_exists($m, $key)){
                        $m->$key = $value;
                    }
                }
            }
        }

        $controllerName = "com\\readysteadyrainbow\\controllers\\" . $c . "Controller";
        $action = $a;
        $controller = new $controllerName($action);
        $actionResult = $controller->{$action}($m);
        $actionResult->ExecuteResult();
    }

    public $action;

    function __construct($action){
        $this->action = $action;
    }

    public function View($model = null, $name = null){
        $actionResult = new ViewResult();
        $actionResult->model = $model;
        $actionResult->viewName = ucfirst($this->action);
        if ($name != null){
            $actionResult->viewName = ucfirst($name);
        }
        return $actionResult;
    }

    public function RedirectToAction($action){
        $actionResult = new RedirectToRouteResult();
        $name = get_class($this);
        $parts = explode("\\", $name);
        $cn = $parts[count($parts)-1];
        $cn = str_replace("Controller", "", $cn);
        $actionResult->route = "/" . $cn . "/" . $action;
        return $actionResult;
    }

}