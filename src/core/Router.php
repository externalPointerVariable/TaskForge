<?php
namespace App\Core;

use App\Controllers\DashboardController;

class Router {
    public function handle(string $uri, string $method): array {
        $uri = rtrim($uri, '/');

        if ($uri === '/dashboard' && $method === 'GET') {
            return (new DashboardController)->index();
        }

        http_response_code(404);
        return ['view' => 'error', 'data' => ['message' => 'Route not found']];
    }
}

?>