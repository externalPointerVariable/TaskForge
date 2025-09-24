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

                    $managerId = $_SESSION['user']['id'] ?? 0;
                    $employees = (new EmployeeController())->fetchEmployees($managerId)['data']['employees'] ?? [];

                    return ['view' => 'Employee', 'data' => ['employees' => $employees]];
                },
                
                'POST /employee/add' => function () {
                    $role = $_SESSION['user']['role'] ?? null;

                    if ($role !== 'Manager') {
                        return ['view' => 'Error', 'data' => ['message' => 'Access denied. Manager role required.']];
                    }

                    $managerId = $_SESSION['user']['id'] ?? null;

                    $postData = [
                        'manager_id' => $managerId,
                        'name'       => trim($_POST['fullName'] ?? ''),
                        'email'      => trim($_POST['email'] ?? ''),
                        'password'   => $_POST['password'] ?? ''
                    ];

                    return (new EmployeeController())->addEmployee($postData);
                },

                'POST /assign' => function () {
                    $role = $_SESSION['user']['role'] ?? null;

                    if ($role !== 'Manager') {
                        return ['view' => 'Error', 'data' => ['message' => 'Access denied. Manager role required.']];
                    }

                    return (new DashboardController())->assignTask($_POST);
                },

                'GET /tasks' => function () {
                    $role = $_SESSION['user']['role'] ?? null;

                    if ($role !== 'Manager') {
                        return ['view' => 'Error', 'data' => ['message' => 'Access denied. Manager role required.']];
                    }

                    $managerId = $_SESSION['user']['id'] ?? 0;
                    $tasks = (new DashboardController())->listTasksAdmin($managerId)['data']['tasks'] ?? [];

                    return ['view' => 'Tasks', 'data' => ['tasks' => $tasks]];
                }
            ];
        }
    }

    return EmployeeRouter::routes();
?>