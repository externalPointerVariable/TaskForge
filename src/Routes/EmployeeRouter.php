<?php
    use App\Controllers\EmployeeController;
    use App\Controllers\DashboardController;

    class EmployeeRouter {
        public static function routes(): array {
            return [
                'GET /employee' => function () {
                    $role = $_SESSION['user']['role'] ?? null;

                    if ($role !== 'Manager') {
                        return ['view' => 'Error', 'data' => ['message' => 'Access denied. Manager role required.']];
                    }

                    return ['view' => 'Employee'];
                },

                'POST /employee/add' => function () {
                    $role = $_SESSION['user']['role'] ?? null;

                    if ($role !== 'Manager') {
                        return ['view' => 'Error', 'data' => ['message' => 'Access denied. Manager role required.']];
                    }

                    return (new EmployeeController())->addEmployee($_POST);
                },

                'GET /employee/fetch' => function () {
                    $role = $_SESSION['user']['role'] ?? null;

                    if ($role !== 'Manager') {
                        return ['view' => 'Error', 'data' => ['message' => 'Access denied. Manager role required.']];
                    }

                    $managerId = $_SESSION['user']['id'] ?? 0;
                    return (new EmployeeController())->fetchEmployees($managerId);
                },

                'POST /assign' => function () {
                    $role = $_SESSION['user']['role'] ?? null;

                    if ($role !== 'Manager') {
                        return ['view' => 'Error', 'data' => ['message' => 'Access denied. Manager role required.']];
                    }

                    return (new DashboardController())->assignTask($_POST);
                },
            ];
        }
    }

    return EmployeeRouter::routes();
?>