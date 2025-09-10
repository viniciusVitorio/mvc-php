<?php

namespace src\Facades;

class Route
{
    private static array $routes = [];

    public static function get(string $uri, callable|array $action): void
    {
        self::$routes['GET'][$uri] = $action;
    }

    public static function post(string $uri, callable|array $action): void
    {
        self::$routes['POST'][$uri] = $action;
    }

    public static function dispatch(string $method, string $uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $routes = self::$routes[$method] ?? [];

        if (isset($routes[$uri])) {
            $action = $routes[$uri];

            if (is_array($action)) {
                [$controller, $method] = $action;
                $controllerInstance = new $controller();
                return $controllerInstance->$method();
            }

            if (is_callable($action)) {
                return $action();
            }
        }

        http_response_code(404);
        echo "404 - Rota não encontrada!";
        return null;
    }
}
