<?php

// main array key is url and supports preg_match patterns
// for get id in function use (\d+)
return [
    // FilmController
    '/' => [
        'controller' => 'FilmController',
        'action' => 'showAll'
    ],

    '/film/(\d+)' => [
        'controller' => 'FilmController',
        'action' => 'show'
    ],
    '/film/create' => [
        'controller' => 'FilmController',
        'action' => 'create'
    ],
    '/film/store' => [
        'controller' => 'FilmController',
        'action' => 'store'
    ],
    '/film/destroy/(\d+)' => [
        'controller' => 'FilmController',
        'action' => 'destroy'
    ],

    // ImportController
    '/import' => [
        'controller' => 'ImportController',
        'action' => 'index'
    ],
    '/import/upload' => [
        'controller' => 'ImportController',
        'action' => 'upload'
    ],
];
