<?php

/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 22/08/15
 * Time: 20:23
 */

namespace com\readysteadyrainbow\models;


class UploadAnimationModel extends BaseModel
{
    public $atlas;
    public $texture;
    public $json;
    public $animation;

    public static function newErrorInstance($message){
        $m = new UploadAnimationModel();
        $m->error = new ErrorDetails();
        $m->error->message = $message;
        return $m;
    }
}