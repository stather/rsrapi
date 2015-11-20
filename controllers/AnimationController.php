<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 26/08/15
 * Time: 20:21
 */

namespace com\readysteadyrainbow\controllers;

use ArrayObject;
use Aws\S3\Exception\S3Exception;
use com\readysteadyrainbow\models\Animation;
use com\readysteadyrainbow\models\ListAnimationsModel;
use com\readysteadyrainbow\models\UploadAnimationModel;
use com\readysteadyrainbow\utility\ImageProcessor;
use com\readysteadyrainbow\entities\AnimationQuery;
use Intervention\Image\ImageManagerStatic as Image;

class AnimationController extends Controller
{
    public function uploadImage($model){
        $imageFile = $model->image['tmp_name'];
        $animationName = $model->name;
        $imageDestName = $animationName . 'RewardImage.png';

        global $s3;


        try {
            $s3->putObject([
                'Bucket' => 'appy-little-eaters',
                'Key' => "animations/"  . $animationName . "/" . $imageDestName,
                'Body' => fopen($imageFile, 'r'),
                'ACL' => 'public-read',
            ]);
        } catch (S3Exception $e) {
            $model->error->message = $e->getMessage();
            return $this->View($model, "UploadAnimation");
        }
        return $this->RedirectToAction("listAnimations");
    }

    public function deleteAnimation($name)
    {
        global $s3;
        $base = "s3://appy-little-eaters/animations/" . $name;
        $source = "animations/" . $name . "/";
        $files = new ArrayObject();
        $res = opendir($base);
        while (false !== ($entry = readdir($res))) {
            $files->append($entry);
        }
        closedir($res);
        $anim = AnimationQuery::create()->findOneByName($name);
        if ($anim != null) {
            $anim->delete();
        }
        foreach ($files as $file){
            $s = $source . $file;
            try {
                $result = $s3->deleteObject(
                    array(
                        'ACL' => 'public-read',
                        // Bucket is required
                        'Bucket' => 'appy-little-eaters',
                        // Key is required
                        'Key' => $s,
                        'MetadataDirective' => 'REPLACE'
                    ));
            } catch (S3Exception $e) {
                return $this->RedirectToAction("listAnimations");
            }
        }
        return $this->RedirectToAction("listAnimations");
    }

    public function listAnimations(){
        error_log("stuff\n", 3, "/tmp/mylog.txt");
        $res = opendir("s3://appy-little-eaters/animations");
        $m = new ListAnimationsModel();
        while (false !== ($entry = readdir($res))) {
            $a = new Animation();
            $a->name = $entry;
            $a->thumbNailUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . "Thumb.jpg";
            $a->rewardImage = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . "RewardImage.png";
            $m->addAnimation($a);
        }
        closedir($res);
        return $this->View($m);
    }

    public function listAnimationsJson(){
        error_log("stuff\n", 3, "/tmp/mylog.txt");
        $res = opendir("s3://appy-little-eaters/animations");
        $m = new ListAnimationsModel();
        while (false !== ($entry = readdir($res))) {
            $a = new Animation();
            $anim = AnimationQuery::create()->findOneByName($entry);
            if ($anim == null){
                $a->version = 0;
            }else{
                $a->version = $anim->getVersion();
            }
            $a->name = $entry;
            $a->thumbNailUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . "Thumb.jpg";
            $a->atlasUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . ".atlas";
            $a->textureUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . ".png";
            $a->jsonUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . ".json";
            $a->rewardImage = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . "RewardImage.png";
            $m->addAnimation($a);
        }
        closedir($res);
        return $this->View($m);
    }

    public function uploadAnimation(){
        $m = new UploadAnimationModel();
        return $this->View($m);
    }

    public function upload($model){
        if ($model->atlas['name'] == "") {
            $model->error->message = "You must specify an atlas file";
            return $this->View($model, "UploadAnimation");
        }
        $atlasFile = $model->atlas['tmp_name'];
        if ($model->texture['name'] == "") {
            $model->error->message = "You must specify a texture file";
            return $this->View($model, "UploadAnimation");
        }
        $textureFile = $model->texture['tmp_name'];
        if ($model->json['name'] == "") {
            $model->error->message = "You must specify a texture file";
            return $this->View($model, "UploadAnimation");
        }
        $jsonFile = $model->json['tmp_name'];

        if ($model->animation == "") {
            $model->error->message = "You must specify an animation name";
            return $this->View($model, "UploadAnimation");
        }
        $animationName = $model->animation;
        $atlasDestName = $animationName . '.atlas';
        $textureDestName = $animationName . '.png';
        $jsonDestName = $animationName . '.json';

        $p = new ImageProcessor($textureFile);
        $p->resizeKeepAspect(50);
        $thumbSource = $p->getFilename();

        $thumbDestName = $animationName . "Thumb.jpg";

        /** @var \com\readysteadyrainbow\entities\Animation $anim */
        $anim = AnimationQuery::create()->findOneByName($animationName);
        if ($anim == null){
            $anim = new \com\readysteadyrainbow\entities\Animation();
            $anim->setName($animationName);
            $anim->setVersion(1);
            $anim->save();
        }else{
            $anim->setVersion($anim->getVersion()+1);
            $anim->save();
        }

        global $s3;


        try {
            $s3->putObject([
                'Bucket' => 'appy-little-eaters',
                'Key' => "animations/"  . $animationName . "/" . $atlasDestName,
                'Body' => fopen($atlasFile, 'r'),
                'ACL' => 'public-read',
            ]);
            $s3->putObject([
                'Bucket' => 'appy-little-eaters',
                'Key' => "animations/"  . $animationName . "/" . $textureDestName,
                'Body' => fopen($textureFile, 'r'),
                'ACL' => 'public-read',
            ]);
            $s3->putObject([
                'Bucket' => 'appy-little-eaters',
                'Key' => "animations/"  . $animationName . "/" . $jsonDestName,
                'Body' => fopen($jsonFile, 'r'),
                'ACL' => 'public-read',
            ]);
            $s3->putObject([
                'Bucket' => 'appy-little-eaters',
                'Key' => "animations/"  . $animationName . "/" . $thumbDestName,
                'Body' => fopen($thumbSource, 'r'),
                'ACL' => 'public-read',
            ]);
        } catch (S3Exception $e) {
            $model->error->message = $e->getMessage();
            return $this->View($model, "UploadAnimation");
        }
        return $this->RedirectToAction("listAnimations");
    }

}