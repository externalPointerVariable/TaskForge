<?php
    namespace App\Controllers;
    use App\Models\UserModel;
    use App\Models\EmployeeRosterModel;

    class EmployeeController {
        public function addEmployee(array $data): bool {
            $roster = EmployeeRosterModel::fetch($data['manager_id']);

            $employees = $roster ? $roster['associated_employees_id'] : [];
            $employees[] = $data['employee_id'];

            if ($roster) {
                return EmployeeRosterModel::update([
                    'manager_id' => $data['manager_id'],
                    'associated_employees_id' => $employees
                ]);
            } else {
                return EmployeeRosterModel::create([
                    'manager_id' => $data['manager_id'],
                    'associated_employees_id' => $employees
                ]);
            }
        }

        public function fetchEmployees(int $managerId): array|bool {
            $roster = EmployeeRosterModel::fetch($managerId);
            if (!$roster || empty($roster['associated_employees_id'])) {
                return false;
            }

            $employees = [];
            foreach ($roster['associated_employees_id'] as $id) {
                $user = UserModel::fetch(['email' => '', 'password' => '']);
                if ($user && $user['id'] == $id) {
                    $employees[] = $user;
                }
            }

            return $employees;
        }
    }
?>