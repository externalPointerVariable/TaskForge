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

                    $managerId = $_SESSION['user']['id'] ?? null;

                    // ✅ Normalize and inject manager ID
                    $postData = [
                        'title'        => trim($_POST['title'] ?? ''),
                        'description'  => trim($_POST['description'] ?? ''),
                        'assigned_to'  => $_POST['assigned_to'] ?? null,
                        'manager_id'   => $managerId
                    ];
                    return (new DashboardController())->assignTask($postData);
                },

                'GET /tasks' => function () {
                    $role = $_SESSION['user']['role'] ?? null;
                    $managerId = $_SESSION['user']['id'];

                    // 🔐 Role check
                    if ($role !== 'Manager' || !$managerId) {
                        echo "<h3>🚫 Access Denied</h3>";
                        return ['view' => 'Error', 'data' => ['message' => 'Access denied. Manager role required.']];
                    }

                    // ✅ Fetch tasks from controller
                    $controller = new DashboardController();
                    $response = $controller->listTasksAdmin($managerId);

                    // 🔍 Debug: Print full response
                    echo "<h3>📋 Raw Response from Controller:</h3><pre>";
                    print_r($response);
                    echo "</pre>";

                    // 🔍 Debug: Print just the tasks array
                    $tasks = $response['data']['tasks'] ?? [];
                    echo "<h3>📦 Extracted Tasks:</h3><pre>";
                    print_r($tasks);
                    echo "</pre>";

                    return ['view' => 'Tasks', 'data' => ['tasks' => $tasks]];
                }
           ];
        }
    }

    return EmployeeRouter::routes();
?>