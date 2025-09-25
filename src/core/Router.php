<?php
declare(strict_types=1);
namespace App\Core;

use App\Middleware\UserMiddleware;
use App\Middleware\UserRoleMiddleware;

class Router {
    private array $routes = [];

    public function __construct() {
        foreach (glob(__DIR__ . '/../Routes/*.php') as $file) {
            $routes = require $file;
            $this->routes += $routes;
        }
    }

    public function handle(string $uri, string $method): array {
        $method = strtoupper($method);
        $path = '/' . trim(parse_url($uri, PHP_URL_PATH), '/');

        $key = match ($path) {
            '/', '/index.php', '/public' => "$method /",
            default => "$method $path"
        };

        if (isset($this->routes[$key])) {
            if ($this->requiresAuth($key)) {
                $authCheck = UserMiddleware::enforceAuth();
                if ($authCheck) return $authCheck;
            }

            if ($role = $this->requiresRole($key)) {
                $roleCheck = UserRoleMiddleware::enforce($role);
                if ($roleCheck) return $roleCheck;
            }

            return $this->routes[$key]();
        }

        http_response_code(404);
        return ['view' => 'error', 'data' => ['message' => 'Route not found']];
    }

    private function requiresAuth(string $key): bool {
        return in_array($key, [
            'GET /dashboard',
            'POST /assign',
            'GET /employee/fetch',
            'POST /employee/add',
            'GET /profile',
            'POST /profile/update'
        ]);
    }

    private function requiresRole(string $key): string|null {
        return match ($key) {
            'GET /employee' => 'manager',
            'GET /dashboard' => 'employee',
            default => null
        };
    }
}