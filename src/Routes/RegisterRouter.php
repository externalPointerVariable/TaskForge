<?php
    declare(strict_types=1);

    use App\Controllers\UserController;

    class RegisterRouter {
        public static function routes(): array {
            return [
                'GET /register' => fn() => ['view' => 'Register'],
                'POST /register' => fn() => (new UserController())->createUser($_POST),
            ];
        }
    }

    return RegisterRouter::routes();
?>