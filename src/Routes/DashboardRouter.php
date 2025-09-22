<?php
    use App\Controllers\DashboardController;

    class DashboardRouter {
        public static function routes(): array {
            return [
                'GET /dashboard' => fn() => (new DashboardController)->listTasks($id),
                'POST /update'   => fn() => (new DashboardController)->updateTaskStatus($_POST),
            ];
        }
    }

    return DashboardRouter::routes();
?>