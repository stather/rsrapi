<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 26/08/15
 * Time: 20:37
 */

namespace com\readysteadyrainbow\controllers;



class ViewResult extends ActionResult
{
    public $model;
    public $viewName;

    public function ExecuteResult(){
        global $app;
        $app->render($this->viewName . '.twig', array('model' => $this->model));
    }
}