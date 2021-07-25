<?php

namespace app\core;

class View
{
    public function showPage($page, array $vars = [])
    {
        extract($vars);

        //default variables
        $currentPage = $page;

        //uploading templates
        $page = 'app/views/' . $page . '.php';

        ob_start();
        require_once $page;
        $content  = ob_get_clean();

        require_once 'app/views/layout.php';
    }

    static function error($errorCode)
    {
        echo $errorCode;
    }

    static public function message(string $message)
    {
        echo '<script language="javascript">';
        echo 'alert("' . $message . '")';
        echo '</script>';
    }
}