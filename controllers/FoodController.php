<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 28/08/15
 * Time: 20:40
 */

namespace com\readysteadyrainbow\controllers;


use ArrayObject;
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use com\readysteadyrainbow\entities\FoodQuery;
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

    public function deleteFood($name, $free, $colour){

        global /** @var S3Client $s3 */
        $s3;

        if ($free == "1"){
            $base = "s3://appy-little-eaters/freefood/" . $colour . '/' . $name;
            $source = "freefood/"  . $colour . "/" . $name . "/";
        }else{
            $base = "s3://appy-little-eaters/food/" . $colour . '/' . $name;
            $source = "food/"  . $colour . "/" . $name . "/";
        }

        $files = new ArrayObject();
        $res = opendir($base);
        while (false !== ($entry = readdir($res))) {
            $a = new Food();
            $a->name = $entry;
            $files->append($a->name);
        }
        closedir($res);
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
                $model = $this->BuildFoodModel();
                $model->error->message = $e->getMessage();
                return $this->View($model, "listFood");
            }
        }

        return $this->View($this->BuildFoodModelForColour($colour), "listFood");
    }

    public function toggleFree($name, $free, $colour){

        global /** @var S3Client $s3 */
        $s3;

        $imageDestName = $name . ".png";

        if ($free == "1"){
            $base = "s3://appy-little-eaters/freefood/" . $colour . '/' . $name;
            $source = "freefood/"  . $colour . "/" . $name . "/";
            $dest = "food/"  . $colour . "/" . $name . "/";
        }else{
            $base = "s3://appy-little-eaters/food/" . $colour . '/' . $name;
            $source = "food/"  . $colour . "/" . $name . "/";
            $dest = "freefood/"  . $colour . "/" . $name . "/";
        }

        $files = new ArrayObject();
        $res = opendir($base);
        while (false !== ($entry = readdir($res))) {
            $a = new Food();
            $a->name = $entry;
            $files->append($a->name);
        }
        closedir($res);
        foreach ($files as $file){
            $s = $source . $file;
            $d = $dest . $file;
            try {
                $result = $s3->copyObject(
                    array(
                    'ACL' => 'public-read',
                    // Bucket is required
                    'Bucket' => 'appy-little-eaters',
                    // CopySource is required
                    'CopySource' =>  'appy-little-eaters/' . $s,
                    // Key is required
                    'Key' => $d,
                    'MetadataDirective' => 'REPLACE'
                ));
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
                $model = $this->BuildFoodModel();
                $model->error->message = $e->getMessage();
                return $this->View($model, "listFood");
            }
        }



        return $this->View($this->BuildFoodModelForColour($colour), "listFood");
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

    /**
     * @param $colour
     * @return ListFoodsModel
     */
    private function BuildFoodModelForColour($colour){
        $m = new ListFoodsModel();
        $base = "s3://appy-little-eaters/food/" . $colour;
        $httpbase = "https://s3.amazonaws.com/appy-little-eaters/food/" . $colour;
        $res = opendir($base);
        while (false !== ($entry = readdir($res))) {
            $a = new Food();
            $f = FoodQuery::create()->filterByColour($colour)->findOneByName($entry);
            if ($f == null){
                $a->version = 0;
            }else{
                $a->version = $f->getVersion();
            }
            $a->name = $entry;
            $a->thumbNailUrl = $httpbase . "/" . $entry . "/" . $entry . "Thumb.jpg";
            $a->imageUrl = $httpbase . "/" . $entry . "/" . $entry . ".png";
            $a->soundUrl = $httpbase . "/" . $entry . "/" . $entry . ".m4a";
            $a->free = false;
            $a->colour = $colour;
            $m->addFood($a);
        }
        closedir($res);
        $base = "s3://appy-little-eaters/freefood/" . $colour;
        $httpbase = "https://s3.amazonaws.com/appy-little-eaters/freefood/" . $colour;
        $res = opendir($base);
        while (false !== ($entry = readdir($res))) {
            $a = new Food();
            $f = FoodQuery::create()->filterByColour($colour)->findOneByName($entry);
            if ($f == null){
                $a->version = 0;
            }else{
                $a->version = $f->getVersion();
            }
            $a->name = $entry;
            $a->thumbNailUrl = $httpbase . "/" . $entry . "/" . $entry . "Thumb.jpg";
            $a->imageUrl = $httpbase . "/" . $entry . "/" . $entry . ".png";
            $a->soundUrl = $httpbase . "/" . $entry . "/" . $entry . ".m4a";
            $a->free = true;
            $a->colour = $colour;
            $m->addFood($a);
        }
        closedir($res);
        $m->foodColour = $this->colour;
        return $m;
    }

    private function BuildFoodModel(){
        return $this->BuildFoodModelForColour($this->colour);
    }

    public function ListFood(){
        return $this->View($this->BuildFoodModel());
    }

    public function ListFoodJson(){
        $a = $this->BuildFoodModelForColour("Red");
        $a->appendModel($this->BuildFoodModelForColour("Orange"));
        $a->appendModel($this->BuildFoodModelForColour("Yellow"));
        $a->appendModel($this->BuildFoodModelForColour("White"));
        $a->appendModel($this->BuildFoodModelForColour("Purple"));
        $a->appendModel($this->BuildFoodModelForColour("Green"));
        return $this->View($a);
    }

    public function uploadSound($model){
        $soundFile = $model->sound['tmp_name'];
        $soundExt = pathinfo($model->sound['name'], PATHINFO_EXTENSION);
        $foodName = $model->name;
        $soundDestName = $foodName . "." . $soundExt;
        $foodColour = $model->colour;

        global /** @var S3Client $s3 */
        $s3;

        if ($model->free == "1"){
            $base = "freefood/"  . $foodColour . "/" . $foodName . "/";
        }else{
            $base = "food/"  . $foodColour . "/" . $foodName . "/";
        }
        try {
            if ($soundFile != "") {
                $s3->putObject([
                    'Bucket' => 'appy-little-eaters',
                    'Key' => $base . $soundDestName,
                    'Body' => fopen($soundFile, 'r'),
                    'ACL' => 'public-read',
                ]);
            }
        } catch (S3Exception $e) {
            $model->error->message = $e->getMessage();
            return $this->View($model, "UploadAnimation");
        }

        return $this->RedirectToAction("listFood");
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

        $f = FoodQuery::create()->filterByColour($foodColour)->findOneByName($foodName);
        if ($f == null){
            $f = new \com\readysteadyrainbow\entities\Food();
            $f->setName($foodName);
            $f->setColour($foodColour);
            $f->setVersion(1);
            $f->save();
        }else{
            $f->setVersion($f->getVersion()+1);
            $f->save();
        }

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

        if (property_exists($model, 'free') && $model->free == "yes"){
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