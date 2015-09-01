<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 26/08/15
 * Time: 20:21
 */

namespace com\readysteadyrainbow\controllers;

use Aws\S3\Exception\S3Exception;
use com\readysteadyrainbow\models\Animation;
use com\readysteadyrainbow\models\ListAnimationsModel;
use com\readysteadyrainbow\models\UploadAnimationModel;
use com\readysteadyrainbow\utility\ImageProcessor;
use Intervention\Image\ImageManagerStatic as Image;

class AnimationController extends Controller
{
    public function listAnimations(){
        $res = opendir("s3://appy-little-eaters/animations");
        $m = new ListAnimationsModel();
        while (false !== ($entry = readdir($res))) {
            $a = new Animation();
            $a->name = $entry;
            $a->thumbNailUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . "Thumb.jpg";
            $m->addAnimation($a);
        }
        closedir($res);
        return $this->View($m);
    }

    public function listAnimationsJson(){
        $res = opendir("s3://appy-little-eaters/animations");
        $m = new ListAnimationsModel();
        while (false !== ($entry = readdir($res))) {
            $a = new Animation();
            $a->name = $entry;
            $a->thumbNailUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . "Thumb.jpg";
            $a->atlasUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . ".atlas";
            $a->textureUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . ".png";
            $a->jsonUrl = "https://s3.amazonaws.com/appy-little-eaters/animations/" . $entry . "/" . $entry . ".json";
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