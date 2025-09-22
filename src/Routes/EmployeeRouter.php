<?php
    use App\Controllers\EmployeeController;
    use App\Controllers\DashboardController;

    class EmployeeRouter {
        public static function routes(): array {
            return [
                'GET /employee' => fn() => ['view' => 'Employee'],
                'POST /employee/add'    => fn() => (new EmployeeController)->addEmployee($_POST),
                'GET /employee/fetch'   => fn() => (new EmployeeController)->fetchEmployees($_GET['manager_id'] ?? 0),
                'POST /assign'   => fn() => (new DashboardController)->assignTask($_POST),
            ];
        }
    }

    return EmployeeRouter::routes();
?>