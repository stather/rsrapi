<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 05/09/15
 * Time: 20:39
 */

namespace com\readysteadyrainbow\controllers;


use com\readysteadyrainbow\entities\User;
use com\readysteadyrainbow\entities\UserQuery;
use com\readysteadyrainbow\models\AddUserModel;
use com\readysteadyrainbow\models\ListUsersModel;
use com\readysteadyrainbow\models\UserModel;
use Propel\Runtime\Exception\PropelException;

class UserController extends Controller
{
    public function listUsers(){
        $users = UserQuery::create()->find();
        $m = new ListUsersModel();
        foreach ($users as $user){
            $u = new UserModel();
            $u->email = $user->getEmail();
            $m->addUser($u);
        }
        return $this->View($m);
    }

    /**
     * @param AddUserModel $m
     * @return ViewResult
     */
    public function addUser($m){
        try {
            $user = new User();
            $user->setEmail($m->email);
            $user->save();
        }catch (PropelException $e){
            $m->error->message = $e->getMessage();
            return $this->View($m);
        }
        return $this->RedirectToAction('listUsers');
    }
}