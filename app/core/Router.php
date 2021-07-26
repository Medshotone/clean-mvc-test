<?php

namespace app\core;

class Router
{
    protected $routes = [];
    protected $route = [];
    protected $params = [];

    public function __construct()
    {
        $routes = require 'app/routes/routes.php';

        $this->createRoutesSecurity($routes);
    }

    public function createRoutesSecurity($routes)
    {
        foreach ($routes as $route => $params) {
            $route = '#^\\' . $route . '$#';

            $this->routes[$route] = $params;
        }
    }

    public function run()
    {
        if ($this->match()) {
            $path = 'app\controllers\\' . $this->params['controller'];

            if (class_exists($path)) {
                $action = $this->params['action'];

                if (method_exists($path, $action)) {

                    $controller = new $path($this->params);

                    if (strpos($this->route, '(\d+)') !== false) {
                        $id = $this->getIdFromUrl($_SERVER['REQUEST_URI']);

                        $controller->$action((int)$id);
                    } else {
                        $controller->$action();
                    }

                } else {
                    View::error(404);
                }

            } else {
                View::error(404);
            }

        } else {
            View::error(404);
        }
    }

    public function match()
    {
        $url = trim(explode('?', $_SERVER['REQUEST_URI'])[0]);

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url)) {
                $this->params = $params;

                $this->route = $route;

                return true;
            }
        }

        return false;
    }

    public function getIdFromUrl(string $url)
    {
        $exlodedUrl = explode('/', $url);

        $id = end($exlodedUrl);

        return $id;
    }
}
