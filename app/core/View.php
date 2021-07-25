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

    public function returnJson(array $vars = [], int $httpCode = 0)
    {
        header('Content-Type: application/json');
        if ($httpCode) {
            http_response_code($httpCode);
        }

        echo json_encode($vars);
        die();
    }

    static function error(int $errorCode)
    {
        http_response_code($errorCode);
        echo $errorCode;
    }

    static public function message(string $message)
    {
        echo '<script language="javascript">';
        echo 'alert("' . $message . '")';
        echo '</script>';
    }
}