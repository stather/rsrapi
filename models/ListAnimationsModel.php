<?php

/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 23/08/15
 * Time: 19:58
 */
namespace com\readysteadyrainbow\models;

use ArrayObject;


class ListAnimationsModel
{
    public $animations ;

    function __construct(){
        $this->animations = new ArrayObject();
    }

    function addAnimation($a){
        $this->animations->append($a);
    }
}