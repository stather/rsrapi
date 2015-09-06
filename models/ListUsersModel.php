<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 06/09/15
 * Time: 21:49
 */

namespace com\readysteadyrainbow\models;


use ArrayObject;

class UserModel{
    public $email;
}

class ListUsersModel
{
    public $users;

    function __construct(){
        $this->foods = new ArrayObject();
    }

    function addUser($a){
        $this->foods->append($a);
    }

}