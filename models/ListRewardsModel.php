<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 05/10/15
 * Time: 20:37
 */

namespace com\readysteadyrainbow\models;


use ArrayObject;

class RewardModel{
    public $scene;
    public $animation;
    public $level;
    public $name;
}

class ListRewardsModel
{
    public $rewards;

    function __construct(){
        $this->rewards = new ArrayObject();
    }

    function addReward($a){
        $this->rewards->append($a);
    }

}