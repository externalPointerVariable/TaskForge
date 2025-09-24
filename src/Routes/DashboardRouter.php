<?php
    use App\Controllers\DashboardController;

    class DashboardRouter {
        public static function routes(): array {
            return [
                'GET /dashboard' => function () {
                    $user = $_SESSION['user'] ?? null;
                    $userId = isset($user['id']) ? (int) $user['id'] : null;
                    $role = $user['role'] ?? null;

                    if (!$userId || !$role) {
                        return ['view' => 'Error', 'data' => ['message' => 'User not authenticated']];
                    }

                    $controller = new DashboardController();

                    return $controller->listTasks($userId);
                },
                'POST /dashboard/update'   => fn() => (new DashboardController)->updateTaskStatus($_POST),
            ];
        }
    }

    return DashboardRouter::routes();
?>