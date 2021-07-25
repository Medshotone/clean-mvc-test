<?php

require_once 'app/lib/Dev.php';

use app\core\Router;

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');

    if (file_exists($path)) {
        require_once $path;
    }
});

session_start();

if (isset($_SESSION['message'])) {
    \app\core\View::message($_SESSION['message']);
    unset($_SESSION['message']);
}

$router = new Router();
$router->run();
