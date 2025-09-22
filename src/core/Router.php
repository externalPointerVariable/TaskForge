<?php
    declare(strict_types=1);
    namespace App\Core;

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
            $path = parse_url($uri, PHP_URL_PATH);
            $path = '/' . trim($path, '/');        

            if ($path === '/' || $path === '/index.php' || $path === '/public') {
                $key = "$method /";
            } else {
                $key = "$method $path";
            }

            if (isset($this->routes[$key])) {
                return $this->routes[$key]();
            }

            http_response_code(404);
            return ['view' => 'error', 'data' => ['message' => 'Route not found']];
        }
    }
?>