<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $routes = [];

    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$this->normalize($path)] = $handler;
    }

    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$this->normalize($path)] = $handler;
    }

    public function dispatch(string $uri, string $method): void
    {
        $path = $this->normalize(parse_url($uri, PHP_URL_PATH) ?? '/');
        $handler = $this->routes[$method][$path] ?? null;

        if (!$handler) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        [$class, $action] = $handler;
        $controller = $this->resolve($class);

        if (!method_exists($controller, $action)) {
            http_response_code(500);
            echo 'Route handler not found.';
            return;
        }

        $controller->{$action}();
    }

    private function resolve(string $class): object
    {
        return match ($class) {
            \App\Controllers\HomeController::class => new \App\Controllers\HomeController(),
            \App\Controllers\RegistrationController::class => new \App\Controllers\RegistrationController(
                new \App\Services\AuthService(
                    new \App\Repositories\UserRepository(\App\Core\Database::connection())
                )
            ),
            default => new $class(),
        };
    }

    private function normalize(string $path): string
    {
        $path = rtrim($path, '/');
        return $path === '' ? '/' : $path;
    }
}
