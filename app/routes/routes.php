<?php

// main array key is url and supports preg_match patterns
return [
    // PageController
    '/' => [
        'controller' => 'PageController',
        'action' => 'index'
    ],

    // ImportController
    '/import' => [
        'controller' => 'ImportController',
        'action' => 'index'
    ],

    // FilmController
    '/film/(\d+)' => [
        'controller' => 'FilmController',
        'action' => 'show'
    ],
    '/films' => [
        'controller' => 'FilmController',
        'action' => 'showAll'
    ],
    '/film/create' => [
        'controller' => 'FilmController',
        'action' => 'create'
    ],
    '/film/update/(\d+)' => [
        'controller' => 'FilmController',
        'action' => 'update'
    ],
    '/film/delete/(\d+)' => [
        'controller' => 'FilmController',
        'action' => 'delete'
    ],
];
