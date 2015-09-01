<?php
/**
 * Created by PhpStorm.
 * User: russellstather
 * Date: 30/08/15
 * Time: 20:33
 */

namespace com\readysteadyrainbow\utility;


use Intervention\Image\ImageManagerStatic as Image;

class ImageProcessor
{
    private $image;
    private $dirty;
    private $tmpName;

    function __construct($filename){
        $this->image = Image::make($filename);
        $this->dirty = false;
    }

    public function resizeKeepAspect($width){
        $this->image->resize(50, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $this->dirty = true;
    }

    public function save(){
        $this->tmpName = tempnam(sys_get_temp_dir(), 'Tux');
        $this->image->save($this->tmpName);
        $this->dirty = false;
    }

    public function getFilename(){
        if ($this->dirty){
            $this->save();
        }
        return $this->tmpName;
    }

}