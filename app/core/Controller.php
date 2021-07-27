<?php

namespace app\core;

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    /**
     * @param $location
     */
    static public function redirect($location)
    {
        header('Location: ' . $location);
    }
}
