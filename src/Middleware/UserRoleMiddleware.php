<?php
    namespace App\Middleware;

    class UserRoleMiddleware {
        public static function hasRole(string $requiredRole): bool {
            return isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === $requiredRole;
        }

        public static function enforce(string $requiredRole): array|null {
            if (!self::hasRole($requiredRole)) {
                http_response_code(403);
                return ['view' => 'error', 'data' => ['message' => 'Access denied']];
            }
            return null;
        }
    }
?>