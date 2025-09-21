<?php
    declare(strict_types=1);
    namespace App\Models;
    use PDO;

    class UserTasksModel{
        public static function insert(array $data): bool {
            global $pdo;

            $stmt = $pdo->prepare(" INSERT INTO tasks (title, description, assigned_to) VALUES (:title, :description, :assigned_to) ");

            return $stmt->execute([
                ':title'        => $data['title'],
                ':description'  => $data['description'],
                ':assigned_to'  => $data['assigned_to']
            ]);
        }

        public static function fetch(int $id): bool|array {
            global $pdo;

            $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = :id");
            $stmt->execute([':id' => $id]);

            $task = $stmt->fetch(PDO::FETCH_ASSOC);
            return $task ?: false;
        }


        public static function fetchAll(int $userId): bool|array {
            global $pdo;

            $stmt = $pdo->prepare("SELECT * FROM tasks WHERE assigned_to = :user_id");
            $stmt->execute([':user_id' => $userId]);

            $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tasks ?: false;
        }

        public static function update(array $data): bool {
            global $pdo;

            $stmt = $pdo->prepare("
                UPDATE tasks
                SET title = :title,
                    description = :description,
                    status = :status,
                    assigned_to = :assigned_to
                WHERE id = :id
            ");

            return $stmt->execute([
                ':title'       => $data['title'],
                ':description' => $data['description'],
                ':status'      => $data['status'],
                ':assigned_to' => $data['assigned_to'],
                ':id'          => $data['id']
            ]);
        }
    }
?>