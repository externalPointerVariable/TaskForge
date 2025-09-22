<?php
    use App\Controllers\UserController;

    class LoginRouter {
        public static function routes(): array {
            return [
                'GET /login'      => fn() => ['view' => 'Login'],
                'POST /login'     => fn() => (new UserController)->getUser($_POST),
            ];
        }
    }

    return LoginRouter::routes();

?>