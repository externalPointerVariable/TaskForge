<?php
    namespace App\Middleware;

    class UserRoleMiddleware {
        public static function hasRole(string $requiredRole): bool {
            $sessionRole = $_SESSION['user']['role'] ?? null;
            return $sessionRole && strtolower($sessionRole) === strtolower($requiredRole);
        }

        public static function enforce(string $requiredRole, string $customMessage = 'Access denied'): array|null {
            if (!self::hasRole($requiredRole)) {
                http_response_code(403);
                return ['view' => 'Error', 'data' => ['message' => $customMessage]];
            }
            return null;
        }
    }
?>