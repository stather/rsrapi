<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 31/08/15
 * Time: 20:38
 */

namespace com\readysteadyrainbow\models;


use ArrayObject;




class ListFoodsModel extends BaseModel
{
    public $foods ;
    public $foodColour;

    function __construct(){
        parent::__construct();
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
            $o = $it->current();
            $this->foods->append($o);
            $it->next();
        }
    }

}