<?php
    namespace App\Controllers;

    use App\Models\UserModel;
    use App\Models\EmployeeRosterModel;
    use App\Services\ConfirmationMail;

    class EmployeeController {
        public function addEmployee(array $data): array {
            $managerId = $_SESSION['user']['id'] ?? null;
            $name      = trim($data['name'] ?? '');
            $email     = trim($data['email'] ?? '');
            $password  = $data['password'] ?? '';

            if (!$managerId || !$name || !$email || !$password) {
                return ['view' => 'Dashboard', 'data' => ['message' => 'Missing required fields']];
            }

            $userCreated = UserModel::insert([
                'name'     => $name,
                'email'    => $email,
                'password' => $password,
                'role'     => 'Employee'
            ]);

            if (!$userCreated) {
                return ['view' => 'Dashboard', 'data' => ['message' => 'Failed to create employee']];
            }

            $employee = UserModel::fetchByEmail($email);
            if (!$employee || empty($employee['id'])) {
                return ['view' => 'Dashboard', 'data' => ['message' => 'Employee creation incomplete']];
            }

            $employeeId = $employee['id'];

            $roster = EmployeeRosterModel::fetch($managerId);
            $employees = [];

            if ($roster) {
                $employees = $roster['associated_employees_id'] ?? [];
                if (in_array($employeeId, $employees)) {
                    return ['view' => 'Dashboard', 'data' => ['message' => 'Employee already added']];
                }
                $employees[] = $employeeId;
                $success = EmployeeRosterModel::update([
                    'manager_id' => $managerId,
                    'associated_employees_id' => $employees
                ]);
            } else {
                $employees[] = $employeeId;
                $success = EmployeeRosterModel::create([
                    'manager_id' => $managerId,
                    'associated_employees_id' => $employees
                ]);
            }

            if ($success) {
                ConfirmationMail::employeeAdded($_SESSION['user']['name'], $email, $password);
                return ['view' => 'Dashboard', 'data' => ['message' => 'Employee added successfully']];
            }

            return ['view' => 'Dashboard', 'data' => ['message' => 'Failed to add employee to roster']];
        }

        public function fetchEmployees(int $managerId): array {
            $roster = EmployeeRosterModel::fetch($managerId);

            if (!$roster || empty($roster['associated_employees_id'])) {
                return ['view' => 'Dashboard', 'data' => ['message' => 'No employees found']];
            }

            $employees = [];
            foreach ($roster['associated_employees_id'] as $id) {
                $user = UserModel::fetchById($id);
                if ($user) {
                    $employees[] = $user;
                }
            }
            return ['view' => 'Dashboard', 'data' => ['employees' => $employees]];
        }
    }
?>