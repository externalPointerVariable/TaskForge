<?php
    namespace App\Controllers;

    use App\Models\UserModel;
    use App\Models\EmployeeRosterModel;
    use App\Services\ConfirmationMail;

    class EmployeeController {
        public function addEmployee(array $data): array {
            $managerId  = $data['manager_id'] ?? null;
            $employeeId = $data['employee_id'] ?? null;
            $email      = $data['email'] ?? null;
            $password   = $data['password'] ?? null;

            if (!$managerId || !$employeeId || !$email || !$password) {
                return ['view' => 'Dashboard', 'data' => ['message' => 'Missing required fields']];
            }

            $roster = EmployeeRosterModel::fetch($managerId);
            $employees = $roster ? $roster['associated_employees_id'] : [];

            if (in_array($employeeId, $employees)) {
                return ['view' => 'Dashboard', 'data' => ['message' => 'Employee already added']];
            }

            $employees[] = $employeeId;

            $success = $roster
                ? EmployeeRosterModel::update([
                    'manager_id' => $managerId,
                    'associated_employees_id' => $employees
                ])
                : EmployeeRosterModel::create([
                    'manager_id' => $managerId,
                    'associated_employees_id' => $employees
                ]);

            if ($success) {
                ConfirmationMail::employeeAdded($_SESSION['user']['name'], $email, $password);
                return ['view' => 'Dashboard', 'data' => ['message' => 'Employee added successfully']];
            }

            return ['view' => 'Dashboard', 'data' => ['message' => 'Failed to add employee']];
        }

        public function fetchEmployees(int $managerId): array {
            $roster = EmployeeRosterModel::fetch($managerId);

            if (!$roster || empty($roster['associated_employees_id'])) {
                return ['view' => 'Dashboard', 'data' => ['message' => 'No employees found']];
            }

            $employees = [];
            foreach ($roster['associated_employees_id'] as $id) {
                $user = UserModel::fetch(['id' => $id]);
                if ($user) {
                    $employees[] = $user;
                }
            }

            return ['view' => 'Dashboard', 'data' => ['employees' => $employees]];
        }
    }
?>