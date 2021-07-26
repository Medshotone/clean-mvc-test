<?php

namespace app\validation;

trait FilmValidationTrait
{
    /**
     * @param array $data
     */
    public function sanitizeForm(array &$data)
    {
        if (isset($data['title'])) {
            $data['title'] = (string)htmlentities($data['title']);
        } else {
            $data['title'] = '';
        }

        if (isset($data['release_year'])) {
            $data['release_year'] = (int)$data['release_year'];
        } else {
            $data['release_year'] = 0;
        }

        if (isset($data['format'])) {
            $data['format'] = (string)htmlentities($data['format']);
        } else {
            $data['format'] = '';
        }

        if (isset($data['stars'])) {
            $data['stars'] = (string)htmlentities($data['stars']);
        } else {
            $data['stars'] = '';
        }
    }

    /**
     * @param array $data
     * @return array
     */
    public function validateForm(array &$data)
    {
        $this->sanitizeForm($data);

        $error = [];

        if ((mb_strlen($data['title']) < 1) || (mb_strlen($data['title']) > 64)) {
            $error['title'] = 'Title must be between 1 and 64';
        }

        if ((int)$data['release_year'] < 1895 || (int)$data['release_year'] > (int)date('Y')) {
            $error['release_year'] = 'Release year must contain only year, and must be between 1895 and the current';
        }

        if (!$data['format'] || !in_array((string)$data['format'],
                ['VHS', 'DVD', 'Blu-Ray'])) {
            $error['release_year'] = 'Release year must contain only year, and must be between 1895 and the current';
        }

        if (mb_strlen($data['stars']) < 1) {
            $error['stars'] = 'Please indicate name and surname actors';
        }

        return $error;
    }
}
