<?php 

if(! defined('ABSPATH'))
    die();

class IOHelper 
{
	public function uploadDir()
    {
        return wp_upload_dir();
    }

    public function baseDir()
    {
        return $this->uploadDir()['basedir'];
    }

    public function baseUrl()
    {
        return $this->uploadDir()['baseurl'];
    }

    public function createDirectory($path)
    {
        if(! is_writeable($path))
            throw new \Exception("Cannot create directory " . $path);
        if(! is_dir($path))
            mkdir($path, 0755);
    }
}