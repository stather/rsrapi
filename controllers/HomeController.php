<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 28/08/15
 * Time: 20:32
 */

namespace com\readysteadyrainbow\controllers;


class HomeController extends Controller
{
    public function index(){
        return $this->View();
    }
}