<?php

namespace app\traits;

trait UrlTrait
{
    public function getIdFromUrl()
    {
        $exlodedUrl = explode('/', $_SERVER['REQUEST_URI']);

        $id = end($exlodedUrl);

        return $id;
    }
}