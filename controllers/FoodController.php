<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 28/08/15
 * Time: 20:40
 */

namespace com\readysteadyrainbow\controllers;


use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use com\readysteadyrainbow\models\Food;
use com\readysteadyrainbow\models\ListFoodsModel;
use com\readysteadyrainbow\models\UploadFoodModel;
use com\readysteadyrainbow\utility\ImageProcessor;


class FoodController extends Controller
{
    private $colour;

    public function __construct($action){
        parent::__construct($action);
        $this->colour = "Orange";
    }

    public function uploadFood(){
        return $this->View();
    }

    /**
     * @param ListFoodsModel $model
     * @return ViewResult
     */
    public function selectColour($model){
        $this->colour = $model->foodColour;
        return $this->View($this->BuildFoodModel(), "listFood");
    }

    private function BuildFoodModel(){
        $m = new ListFoodsModel();
        $base = "s3://appy-little-eaters/food/" . $this->colour;
        $httpbase = "https://s3.amazonaws.com/appy-little-eaters/food/" . $this->colour;
        $res = opendir($base);
        while (false !== ($entry = readdir($res))) {
            $a = new Food();
            $a->name = $entry;
            $a->thumbNailUrl = $httpbase . "/" . $entry . "/" . $entry . "Thumb.jpg";
            $a->imageUrl = $httpbase . "/" . $entry . "/" . $entry . ".png";
            $a->soundUrl = $httpbase . "/" . $entry . "/" . $entry . ".m4a";
            $a->free = false;
            $m->addFood($a);
        }
        closedir($res);
        $base = "s3://appy-little-eaters/freefood/" . $this->colour;
        $httpbase = "https://s3.amazonaws.com/appy-little-eaters/freefood/" . $this->colour;
        $res = opendir($base);
        while (false !== ($entry = readdir($res))) {
            $a = new Food();
            $a->name = $entry;
            $a->thumbNailUrl = $httpbase . "/" . $entry . "/" . $entry . "Thumb.jpg";
            $a->imageUrl = $httpbase . "/" . $entry . "/" . $entry . ".png";
            $a->soundUrl = $httpbase . "/" . $entry . "/" . $entry . ".m4a";
            $a->free = true;
            $m->addFood($a);
        }
        closedir($res);
        $m->foodColour = $this->colour;
        return $m;
    }

    public function ListFood(){
        return $this->View($this->BuildFoodModel());
    }

    /**
     * @param UploadFoodModel $model
     * @return RedirectToRouteResult|ViewResult
     */
    public function upload($model){
        if ($model->image['name'] == "") {
            $model->error->message = "You must specify an image file";
            return $this->View($model, "UploadFood");
        }
        $imageFile = $model->image['tmp_name'];
//        if ($model->sound['name'] == "") {
//            $model->error->message = "You must specify a sound file";
//            return $this->View($model, "UploadFood");
//        }
        $soundFile = $model->sound['tmp_name'];
        $soundExt = pathinfo($model->sound['name'], PATHINFO_EXTENSION);
        if ($model->food == "") {
            $model->error->message = "You must specify a food name";
            return $this->View($model, "UploadFood");
        }
        $foodName = $model->food;
        $foodColour = $model->colour;

        $imageDestName = $foodName . ".png";
        $soundDestName = $foodName . "." . $soundExt;

        $p = new ImageProcessor($imageFile);
        $p->resizeKeepAspect(50);
        $thumbSource = $p->getFilename();
        $thumbDestName = $foodName . "Thumb.jpg";

        $p = new ImageProcessor($imageFile);
        $p->resizeKeepAspect(200);
        $mainImageSource = $p->getFilename();


        global /** @var S3Client $s3 */
        $s3;

        if ($model->free == "yes"){
            $base = "freefood/"  . $foodColour . "/" . $foodName . "/";
        }else{
            $base = "food/"  . $foodColour . "/" . $foodName . "/";
        }

        try {
            $s3->putObject([
                'Bucket' => 'appy-little-eaters',
                'Key' => $base . $imageDestName,
                'Body' => fopen($mainImageSource, 'r'),
                'ACL' => 'public-read',
            ]);
            if ($soundFile != "") {
                $s3->putObject([
                    'Bucket' => 'appy-little-eaters',
                    'Key' => $base . $soundDestName,
                    'Body' => fopen($soundFile, 'r'),
                    'ACL' => 'public-read',
                ]);
            }
            $s3->putObject([
                'Bucket' => 'appy-little-eaters',
                'Key' => $base . $thumbDestName,
                'Body' => fopen($thumbSource, 'r'),
                'ACL' => 'public-read',
            ]);
        } catch (S3Exception $e) {
            $model->error->message = $e->getMessage();
            return $this->View($model, "UploadAnimation");
        }



        return $this->RedirectToAction("listFood");
    }
}