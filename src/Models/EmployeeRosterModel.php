<?php
    declare(strict_types=1);
    namespace App\Models;
    use PDO;

    class EmployeeRosterModel {
        public static function create(array $data): bool {
            global $pdo;

            $stmt = $pdo->prepare("INSERT INTO employee_roster (manager_id, associated_employees_id) VALUES (:manager_id, :associated_employees_id)
            ");

            return $stmt->execute([
                ':manager_id' => $data['manager_id'],
                ':associated_employees_id' => json_encode($data['associated_employees_id'])
            ]);
        }

        public static function fetch(int $managerId): array|bool {
            global $pdo;

            $stmt = $pdo->prepare("SELECT * FROM employee_roster WHERE manager_id = :manager_id");
            $stmt->execute([':manager_id' => $managerId]);

            $roster = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($roster) {
                $roster['associated_employees_id'] = json_decode($roster['associated_employees_id'], true);
            }

            return $roster ?: false;
        }

        public static function update(array $data): bool {
            global $pdo;

            $stmt = $pdo->prepare(" UPDATE employee_roster
                SET associated_employees_id = :associated_employees_id
                WHERE manager_id = :manager_id
            ");

            return $stmt->execute([
                ':associated_employees_id' => json_encode($data['associated_employees_id']),
                ':manager_id' => $data['manager_id']
            ]);
        }
    }
?>