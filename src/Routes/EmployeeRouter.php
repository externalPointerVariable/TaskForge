<?php
    use App\Controllers\EmployeeController;
    use App\Controllers\DashboardController;

    class EmployeeRouter {
        public static function routes(): array {
            return [
                'GET /employee' => function () {
                    $role = $_SESSION['user']['role'] ?? null;
                    $managerId = $_SESSION['user']['id'] ?? null;

                    if ($role !== 'Manager' || !$managerId) {
                        echo "<h3>🚫 Access Denied</h3>";
                        return ['view' => 'Error', 'data' => ['message' => 'Access denied. Manager role required.']];
                    }

                    $employeeController = new EmployeeController();
                    $employeeResponse = $employeeController->fetchEmployees($managerId);
                    $employees = $employeeResponse['data']['employees'] ?? [];

                    $dashboardController = new DashboardController();
                    $taskResponse = $dashboardController->listTasksAdmin($managerId);
                    $tasks = $taskResponse['data']['tasks'] ?? [];

                    return [
                        'view' => 'Employee',
                        'data' => [
                            'employees' => $employees,
                            'tasks'     => $tasks
                        ]
                    ];
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

                    $managerId = $_SESSION['user']['id'] ?? null;

                    // ✅ Normalize and inject manager ID
                    $postData = [
                        'title'        => trim($_POST['title'] ?? ''),
                        'description'  => trim($_POST['description'] ?? ''),
                        'assigned_to'  => $_POST['assigned_to'] ?? null,
                        'manager_id'   => $managerId
                    ];
                    return (new DashboardController())->assignTask($postData);
                }
           ];
        }
    }

    return EmployeeRouter::routes();
?>