<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 06/10/15
 * Time: 20:30
 */

namespace com\readysteadyrainbow\models;


use ArrayObject;

class SceneModel{
    public $name;
}


class DefineRewardModel{

    public $scenes;
    public $animations;

    function __construct(){
//        parent::__construct();
        $this->scenes = new ArrayObject();
        $this->animations = new ArrayObject();
    }

    function addScene($a){
        $this->scenes->append($a);
    }

    function addAnimation($a){
        $this->animations->append($a);
    }

}
