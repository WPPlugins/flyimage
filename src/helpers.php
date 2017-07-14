<?php
if(! defined('ABSPATH'))
	die();

if(! function_exists('flyImage'))
{
    function flyImage($attachmentId, $width, $height = 0)
    {
        return FlyImageHandler::instance()->getFlyImage($attachmentId, $width, $height);
    }
}

if(! function_exists('flyImageSourceSet'))
{
    function flyImageSourceSet($attachmentId, $widths)
    {
        return FlyImageHandler::instance()->getFlyImageSourceSet($attachmentId, $widths);
    }
}

if(! function_exists('dd'))
{
    function dd($var)
    {
        var_dump($var);exit;
    }
}
