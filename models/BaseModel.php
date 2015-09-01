<?php

/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 23/08/15
 * Time: 19:58
 */
namespace com\readysteadyrainbow\models;

class ErrorDetails
{
    public $message;
}

class BaseModel
{
    public $error;

    function __construct(){
        $this->error = new ErrorDetails();
    }
}