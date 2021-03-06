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
use com\readysteadyrainbow\entities\SceneQuery;
use com\readysteadyrainbow\models\Animation;
use com\readysteadyrainbow\models\DefineRewardModel;
use com\readysteadyrainbow\models\ListRewardsModel;
use com\readysteadyrainbow\models\RewardModel;
use com\readysteadyrainbow\models\SceneModel;
use Propel\Runtime\Exception\PropelException;

class RewardController extends Controller
{
    public function updateRewardPosition($model){
        error_log("updateRewardPosition\n", 3, "/tmp/mylog.txt");
        ob_start();
        var_dump($model);
        $b = ob_get_contents();
        ob_end_clean();
        error_log($b, 3, "/tmp/mylog.txt");
        $a = 2;
        $rewards = RewardQuery::create()->findByName($model->name);
        /** @var Reward $reward */
        $reward = $rewards->getFirst();
        $reward->setX($model->x);
        $reward->setY($model->y);
        $reward->setScale($model->scale);
        $reward->save();
        return $this->View();
    }

    public function defineReward(){
        $model = new DefineRewardModel();
        $scenes = SceneQuery::create()->find();
        foreach ($scenes as $scene){
            $s = new SceneModel();
            $s->name = $scene->getName();
            $model->addScene($s);
        }
        $res = opendir("s3://appy-little-eaters/animations");
        while (false !== ($entry = readdir($res))) {
            $a = new Animation();
            $a->name = $entry;
            $a->thumbNailUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . "Thumb.jpg";
            $a->atlasUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . ".atlas";
            $a->textureUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . ".png";
            $a->jsonUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . ".json";
            $model->addAnimation($a);
        }
        closedir($res);

        return $this->View($model);
    }

    public function define($model){
        try {
            $reward = new Reward();
            $reward->setAnimationname($model->animation);
            $reward->setLevel($model->level);
            $reward->setScene($model->scene);
            $reward->setName($model->name);
            $reward->setX(0);
            $reward->setY(0);
            $reward->setScale(1);
            $reward->save();
        }catch (PropelException $e){
            $model->error->message = $e->getMessage();
            return $this->View($model);
        }

        return $this->RedirectToAction("listRewards");
    }

    public function listRewards(){
        $rewards = RewardQuery::create()->orderByAnimationname()->find();
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

    public function listRewardsJson(){
        $rewards = RewardQuery::create()->find();
        $m = new ListRewardsModel();
        foreach ($rewards as $reward){
            $r = new RewardModel();
            $r->animation = $reward->getAnimationname();
            $r->name = $reward->getName();
            $r->level = $reward->getLevel();
            $r->scene = $reward->getScene();
            $r->x = $reward->getX();
            $r->y = $reward->getY();
            $r->scale = $reward->getScale();
            $m->addReward($r);
        }
        return $this->View($m);
    }

    public function deleteReward($name){
        return $this->RedirectToAction("listRewards");
        $reward = RewardQuery::create()->findByName($name);
        $reward->delete();
        return $this->RedirectToAction("listRewards");
    }
}