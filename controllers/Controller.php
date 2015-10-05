<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 26/08/15
 * Time: 20:24
 */

namespace com\readysteadyrainbow\controllers;


use ReflectionMethod;
use stdClass;

class Controller
{


    public static function Dispatch($c, $a)
    {
        global $app;

        $controllerName = "com\\readysteadyrainbow\\controllers\\" . $c . "Controller";
        $action = $a;
        $controller = new $controllerName($action);

        $dynmodel = new StdClass;
        foreach ($_FILES as $key => $value) {
            $dynmodel->$key = $value;
        }
        foreach ($_POST as $key => $value) {
            $dynmodel->$key = $value;
        }

        if (count($_GET) > 0) {
            $refm = new ReflectionMethod($controller, $action);
            $params = array();
            foreach ($refm->getParameters() as $p) {
                $val = $_GET[$p->name];
                $params[] = $val;
                $a = 1;
            }
            $actionResult = call_user_func_array(array($controller, $action), $params);
            $actionResult->ExecuteResult();
            return;
        }

        $actionResult = $controller->{$action}($dynmodel);
        $actionResult->ExecuteResult();
    }

    public
        $action;

    function __construct($action)
    {
        $this->action = $action;
    }

    public
    function View($model = null, $name = null)
    {
        $actionResult = new ViewResult();
        $actionResult->model = $model;
        $actionResult->viewName = ucfirst($this->action);
        if ($name != null) {
            $actionResult->viewName = ucfirst($name);
        }
        return $actionResult;
    }

    public
    function RedirectToAction($action)
    {
        $actionResult = new RedirectToRouteResult();
        $name = get_class($this);
        $parts = explode("\\", $name);
        $cn = $parts[count($parts) - 1];
        $cn = str_replace("Controller", "", $cn);
        $actionResult->route = "/" . $cn . "/" . $action;
        return $actionResult;
    }

}