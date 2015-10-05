<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 05/10/15
 * Time: 20:06
 */

namespace com\readysteadyrainbow\controllers;


use com\readysteadyrainbow\entities\Reward;
use com\readysteadyrainbow\entities\RewardQuery;
use com\readysteadyrainbow\models\ListRewardsModel;
use com\readysteadyrainbow\models\RewardModel;
use Propel\Runtime\Exception\PropelException;

class RewardController extends Controller
{
    public function defineReward(){
        return $this->View();
    }

    public function define($model){
        try {
            $reward = new Reward();
            $reward->setAnimationname($model->animation);
            $reward->setLevel($model->level);
            $reward->setScene($model->scene);
            $reward->setName($model->name);
            $reward->save();
        }catch (PropelException $e){
            $model->error->message = $e->getMessage();
            return $this->View($model);
        }

        return $this->RedirectToAction("listRewards");
    }

    public function listRewards(){
        $rewards = RewardQuery::create()->find();
        $m = new ListRewardsModel();
        foreach ($rewards as $reward){
            $r = new RewardModel();
            $r->animation = $reward->getAnimationname();
            $r->name = $reward->getName();
            $r->level = $reward->getLevel();
            $r->scene = $reward->getScene();
            $m->addReward($r);
        }
        return $this->View($m);
    }
}