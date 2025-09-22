<?php
    namespace App\Middleware;

    class UserMiddleware {
        public static function isAuthenticated(): bool {
            return isset($_SESSION['user']);
        }

        public static function enforceAuth(): array|null {
            if (!self::isAuthenticated()) {
                return ['view' => 'Login', 'data' => ['message' => 'Please log in to continue']];
            }
            return null;
        }

        public static function enforceRole(string $role): array|null {
            if (!self::hasRole($role)) {
                http_response_code(403);
                return ['view' => 'error', 'data' => ['message' => 'Access denied']];
            }
            return null;
        }
    }
?>