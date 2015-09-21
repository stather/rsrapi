<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 21/09/15
 * Time: 20:43
 */

namespace com\readysteadyrainbow\models;


class Food{
    public $name;
    public $thumbNailUrl;
    public $imageUrl;
    public $soundUrl;
    public $free;
    public $colour;

    function __construct(){
        $this->free = false;
    }
}
