<?php
    use App\Controllers\UserController;

    class HomeRouter {
        public static function routes(): array {
            return [
                'GET /'           => fn() => ['view' => 'Home'],
                'GET /index.php'  => fn() => ['view' => 'Home']
            ];
        }
    }

    return HomeRouter::routes();

?>