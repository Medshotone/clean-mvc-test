<?php

namespace app\core;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    static public function redirect($location)
    {
        header('Location: ' . $location);
    }

    static public function redirectWithMessage(string $redirectTo, string $message)
    {
        $_SESSION['message'] = $message;

        self::redirect($redirectTo);
    }
}
