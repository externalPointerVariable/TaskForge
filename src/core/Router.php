<?php
namespace App\Core;

use App\Controllers\DashboardController;

class Router {
    public function handle(string $uri, string $method): array {
        $uri = rtrim($uri, '/');

        if ($uri === '/' || $uri === '') {
           return[
            'view' => 'Home'
           ];
        }
        if ($uri === '/dashboard' && $method === 'GET'){
            return (new DashboardController)->index();
        }
        if ($uri === '/profile'){
            return [
                'view' => 'Profile',
            ];
        }
        if($uri === '/employee'){
            return [
                'view' => 'Employee',
            ];
        }
        if($uri === '/login'){
            return [
                'view' => 'Login',
            ];
        }
        if($uri === '/register'){
            return [
                'view' => 'Register',
            ];
        }

        http_response_code(404);
        return ['view' => 'error', 'data' => ['message' => 'Route not found']];
    }
}

?>