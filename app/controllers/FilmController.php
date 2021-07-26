<?php

namespace app\controllers;

use app\core\Controller;
use app\core\View;
use app\models\Film;
use app\traits\UrlTrait;

class FilmController extends Controller
{
    use UrlTrait;

    private $error = [];
    private $film;

    public function __construct()
    {
        parent::__construct();
        $this->film = new Film();
    }

    public function show()
    {
        $id = $this->getIdFromUrl();

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

        $films = $this->film->all('title');

        $this->view->showPage('film/films', ['films' => $films, 'successMessage' => $successMessage]);
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

        $this->sanitizeForm($_POST);

        if (!$this->validateForm($_POST)) {
            $this->view->returnJson(['errors' => $this->error]);
        }

        if (!$this->film->create($_POST)) {
            $this->view->returnJson(['dbInsertFail' => 'Insert in database failing']);
        }

        $_SESSION['successMessage'] = 'Film successfully added!!!';

        $this->view->returnJson(['redirect' => '/films']);
    }

    public function destroy()
    {
        $id = $this->getIdFromUrl();

        $film = $this->film->find($id);

        if ($film) {
            $_SESSION['successMessage'] = 'Film successfully removed!!!';

            $this->film->delete((int)$film['id']);

            self::redirect('/films');
        } else {
            View::error(404);
        }
    }

    protected function sanitizeForm(array &$postData)
    {
        if (isset($postData['title'])) {
            $postData['title'] = (string)htmlentities($postData['title']);
        } else {
            $postData['title'] = '';
        }

        if (isset($postData['release_year'])) {
            $postData['release_year'] = (int)$postData['release_year'];
        } else {
            $postData['release_year'] = 0;
        }

        if (isset($postData['format'])) {
            $postData['format'] = (string)htmlentities($postData['format']);
        } else {
            $postData['format'] = '';
        }

        if (isset($postData['stars'])) {
            $postData['stars'] = (string)htmlentities($postData['stars']);
        } else {
            $postData['stars'] = '';
        }
    }

    protected function validateForm(array $postData)
    {
        if ((mb_strlen($postData['title']) < 1) || (mb_strlen($postData['title']) > 64)) {
            $this->error['title'] = 'Title must be between 1 and 64';
        }

        if ((int)$postData['release_year'] < 1895 || (int)$postData['release_year'] > (int)date('Y')) {
            $this->error['release_year'] = 'Release year must contain only year, and must be between 1895 and the current';
        }

        if (!$postData['format'] || !in_array((string)$postData['format'],
                ['VHS', 'DVD', 'Blu-Ray'])) {
            $this->error['release_year'] = 'Release year must contain only year, and must be between 1895 and the current';
        }

        if (mb_strlen($postData['stars']) < 1) {
            $this->error['stars'] = 'Please indicate name and surname actors';
        }

        return !$this->error;
    }
}
