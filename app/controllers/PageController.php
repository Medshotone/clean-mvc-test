<?php

namespace app\controllers;

use app\core\Controller;

class PageController extends Controller
{
    public function index()
    {
        $this->view->showPage('home');
    }
}
