<?php

namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\models\Film;
use app\validation\FilmValidationTrait;

class FilmController extends Controller
{
    use FilmValidationTrait;

    private $film;

    public function __construct()
    {
        parent::__construct();
        $this->film = new Film();
    }

    public function show(int $id)
    {
        $film = $this->film->find($id);

        if ($film) {
            $this->view->showPage('film/film', ['film' => $film]);
        } else {
            View::error(404);
        }
    }

    public function showAll()
    {
        $successMessage = '';
        if (isset($_SESSION['successMessage']) && $_SESSION['successMessage']) {
            $successMessage = $_SESSION['successMessage'];
            unset($_SESSION['successMessage']);
        }

        $search = '';
        $searchType = '';
        if ((isset($_GET['search']) && $search = mb_substr($_GET['search'], 0, 128))
            && (isset($_GET['type']) && in_array($_GET['type'], ['title', 'stars']))) {
            $searchType = $_GET['type'];

            switch ($searchType) {
                case 'title':
                    $films = $this->film->where('title', 'LIKE', $search . '%');
                    break;
                case 'stars':
                    $films = $this->film->where('stars', 'LIKE', '%' . $search . '%');
                    break;
            }
        } else {
            $films = $this->film->all('title', 'ASC');
        }

        $this->view->showPage('film/films',
            [
                'films'          => $films,
                'successMessage' => $successMessage,
                'searchType'     => $searchType,
                'search'         => $search,
            ]
        );
    }

    public function create()
    {
        $this->view->showPage('film/create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->view->returnJson(['wrongRequestMethod' => 'Wrong request method, must be POST'], 400);
        }

        if ($errors = $this->validateForm($_POST)) {
            $this->view->returnJson(['errors' => $errors]);
        }

        if (!$this->film->create($_POST)) {
            $this->view->returnJson(['dbInsertFail' => 'Insert in database failing']);
        }

        $_SESSION['successMessage'] = 'Film successfully added!!!';

        $this->view->returnJson(['redirect' => '/']);
    }

    public function destroy(int $id)
    {
        $film = $this->film->find($id);

        if ($film) {
            $_SESSION['successMessage'] = 'Film successfully removed!!!';

            $this->film->delete((int)$film['id']);

            self::redirect('/');
        } else {
            View::error(404);
        }
    }
}
