<?php 
if(! defined('ABSPATH'))
    die();

class FlyImage
{
    public $source;
    public $width;
    public $height;
    public $cropped;

    public function __construct($source, $width, $height, $cropped = false)
    {
        $this->source = $source;
        $this->width = $width;
        $this->height = $height;
        $this->cropped = $cropped;
    }
    
}
