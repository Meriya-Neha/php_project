<?php

class Router {
    private $routes = [];

    // Register a POST route
    public function post(mixed $path, mixed $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    // Register a GET route
    public function get(mixed $path, mixed $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    // Actually run the matching route
    public function resolve() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        echo "DEBUG: method=$method uri=$uri\n";
    echo "DEBUG: registered routes = " . json_encode($this->routes) . "\n";


        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo json_encode(['error' => 'Route not found']);
            return;
        }

        $callback = $this->routes[$method][$uri];

        // callback is like [UserController::class, 'add_user']
        [$class, $methodName] = $callback;
        $controller = new $class();
        $controller->$methodName();
    }
}