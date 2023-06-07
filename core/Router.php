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
        // ...

        // Check if the URI matches the defined routes
        foreach ($this->routes[$requestType] as $route => $controller) {
            // Convert route placeholders to regular expressions
            $pattern = '#^' . preg_replace('#\{([\w]+)\}#', '([\w-]+)', $route) . '$#';

            if (preg_match($pattern, $uri, $matches)) {
                $controllerAction = explode('@', $controller);
                $controllerName = "App\\Controllers\\{$controllerAction[0]}";
                $action = $controllerAction[1];

                $controller = new $controllerName;

                if (!method_exists($controller, $action)) {
                    throw new Exception(
                        "{$controllerName} does not respond to the {$action} action."
                    );
                }

                // Pass the matched route parameters to the controller method
                $params = array_slice($matches, 1);
                $response = $controller->$action(...$params);

                header('Content-Type: application/json');
                echo json_encode($response);
                return;
            }
        }

        throw new Exception('No route defined for this URI.');
    }
}
