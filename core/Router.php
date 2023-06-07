<?php

namespace App\Core;

use Exception;

class Router
{
    /**
     * All registered routes.
     *
     * @var array
     */
    public $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Load a user's routes file.
     *
     * @param string $file
     */
    public static function load($file)
    {
        $router = new static;

        require $file;

        return $router;
    }

    /**
     * Register a GET route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Register a POST route.
     *
     * @param string $uri
     * @param string $controller
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Load the requested URI's associated controller method.
     *
     * @param string $uri
     * @param string $requestType
     */
    public function direct($uri, $requestType)
    {
        if (array_key_exists($uri, $this->routes[$requestType])) {
            $controllerAction = explode('@', $this->routes[$requestType][$uri]);
            $controllerName = "App\\Controllers\\{$controllerAction[0]}";
            $action = $controllerAction[1];

            $controller = new $controllerName;

            if (!method_exists($controller, $action)) {
                throw new Exception(
                    "{$controllerName} does not respond to the {$action} action."
                );
            }

            $response = $controller->$action();

            header('Content-Type: application/json');
            echo json_encode($response);
            return;
        }

        throw new Exception('No route defined for this URI.');
    }
}
