<?php
if(! defined('ABSPATH'))
    die();

require_once('FlyImage.php');
require_once('IOHelper.php');

class FlyImageHandler 
{
    protected static $instance;
    private $ioHelper;
    private $flyDir;
    private $flyUrl;

    private function __construct()
    {
        $this->ioHelper = new IOHelper;

        $this->flyDir = $this->ioHelper->baseDir()  . "/fly/";
        $this->flyUrl = $this->ioHelper->baseUrl() . "/fly/";

        $this->ioHelper->createDirectory($this->flyDir);
    }

    public static function instance($views = null)
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    public function getFlyImageSourceSet($attachmentId, $widths)
    {
        $sourceSet = "";
        foreach($widths as $width)
        {
            $flyImage =  $this->getFlyImage($attachmentId, $width);
            $sourceSet .= "{$flyImage->source} {$width}w";

            if($width != end($widths))
                $sourceSet .= " ,";
        }
        return $sourceSet;
    }
    

    public function getFlyImage($attachmentId, $width, $height = 0, $crop = true)
    {
        if(! is_numeric($attachmentId))
            $attachmentId = $this->getAttachmentId($attachmentId);

        $attachment = wp_get_attachment_metadata($attachmentId);

        if(! $attachment) return null;
        
        $flyImageName = $this->flyImageName($attachment, $width, $height);
        $flyImagePath = $this->flyDir . $flyImageName;
        $flyImageUrl = $this->flyUrl . $flyImageName;

        if(! file_exists($flyImagePath))
            $this->resizeImage($attachmentId, $width, $height, $flyImagePath, $crop); 

        return new FlyImage($flyImageUrl, $width, $height);
    }

    private function getAttachmentId($fileName)
    {
        global $wpdb;
        $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $fileName)); 

        if(count($attachment) == 0)
            throw new \Exception("Image with name or URL " + $fileName + " could not be found.");

        return $attachment[0]; 
    }

    private function resizeImage($attachmentId, $width, $height, $path, $crop)
    {
        $wpImageEditor = wp_get_image_editor(get_attached_file($attachmentId));
        $wpImageEditor->resize($width, $height, $crop);
        $wpImageEditor->save($path);
    }

    private function flyImageName($attachment, $width, $height)
    {
        $fileType = pathinfo($attachment['file'], PATHINFO_EXTENSION);
        $fileName = basename($attachment['file'], $fileType);

        return "{$fileName}_{$width}_{$height}.{$fileType}";
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
