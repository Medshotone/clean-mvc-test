<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Film;
use app\traits\FileUploadTrait;
use app\validation\FilmValidationTrait;

class ImportController extends Controller
{
    use FileUploadTrait;
    use FilmValidationTrait;

    private $film;

    public function __construct()
    {
        parent::__construct();
        $this->film = new Film();
    }

    public function index()
    {
        $successMessage = '';
        if (isset($_SESSION['successMessage']) && $_SESSION['successMessage']) {
            $successMessage = $_SESSION['successMessage'];
            unset($_SESSION['successMessage']);
        }

        $errorMessage = '';
        if (isset($_SESSION['errorMessage']) && $_SESSION['errorMessage']) {
            $errorMessage = $_SESSION['errorMessage'];
            unset($_SESSION['errorMessage']);
        }

        $this->view->showPage('import',
            [
                'errorMessage'        => $errorMessage,
                'successMessage'      => $successMessage,
            ]
        );
    }

    public function upload()
    {
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] !== '') {
            $result = $this->uploadImage($_FILES['file'], 'imports');

            if (is_array($result)) {
                // has upload errors
                $_SESSION['errorMessage'][] = $result;
            } elseif (is_string($result)) {
                // success upload

                $films = $this->parseImport($result);

                if ($films) {
                    $i = 0;

                    foreach ($films as $index => $film) {
                        if ($this->validateForm($film)) {
                            $_SESSION['errorMessage'][] = 'Some films have invalid data';

                            continue;
                        }

                        if (!$this->film->create($film)) {
                            $_SESSION['errorMessage'][] = 'Insert in database failing';

                            continue;
                        }

                        $i++;
                    }

                    if ($i) {
                        $_SESSION['successMessage'] = 'Films successfully added!!!';
                    }
                } else {
                    $_SESSION['errorMessage'][] = 'Not founded available content, check import content';
                }
            }
        } else {
            $_SESSION['errorMessage'][] = 'Tmp file not founded';
        }

        self::redirect('/import');
    }

    protected function parseImport(string $filePath)
    {
        $txt_file = file_get_contents($filePath);
        $rows = explode("\n", $txt_file);

        $i = 0;
        $films = [];
        foreach ($rows as $row => $data) {
            $row_data = trim($data);

            if (!$row_data) {
                $i++;
                continue;
            }

            if (mb_strpos($row_data, ':') !== false) {
                $tmp_explode = explode(':', $row_data);

                if (($key = str_replace(' ', '_',
                        mb_strtolower(trim($tmp_explode[0])))) && (isset($tmp_explode[1]) && $value = trim($tmp_explode[1]))) {
                    $films[$i][mb_strtolower($key)] = $value;
                }
            }
        }

        return $films;
    }
}
