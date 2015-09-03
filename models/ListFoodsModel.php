<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 31/08/15
 * Time: 20:38
 */

namespace com\readysteadyrainbow\models;


use ArrayObject;


class Food{
    public $name;
    public $thumbNailUrl;
    public $imageUrl;
    public $soundUrl;
    public $free;

    function __construct(){
        $this->free = false;
    }
}


class ListFoodsModel
{
    public $foods ;
    public $foodColour;

    function __construct(){
        $this->foods = new ArrayObject();
    }

    function addFood($a){
        $this->foods->append($a);
    }

    /**
     * @param ListFoodsModel $m
     */
    function appendModel($m){
        $it = $m->foods->getIterator();
        while ($it->valid()){
            $this->foods->append($it->current());
            $it->next();
        }
    }

}