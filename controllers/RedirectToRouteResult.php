<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 26/08/15
 * Time: 22:26
 */

namespace com\readysteadyrainbow\controllers;


class RedirectToRouteResult extends ActionResult
{
    public $route;

    public function ExecuteResult(){
        global $app;
        $app->response->redirect($this->route, 302);
    }
}