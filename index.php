<?php

// require global config file
if (!is_file('config/config.php')) {
    throw new \Exception("Undefined config/config.php file. Check example in config/config.example.php and rename to config.php");
}
require_once 'config/config.php';

// development settings
if (DEVELOPMENT_MODE == 1) {
    require_once 'app/lib/Dev.php';
}

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
