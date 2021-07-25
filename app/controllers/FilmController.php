<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Film;

class FilmController extends Controller
{
    private $film;

    public function __construct()
    {
        parent::__construct();
        $this->film = new Film();
    }

    public function showAll()
    {
        $films = $this->film->all('title');

        $this->view->showPage('film/films', ['films' => $films]);
    }
}
