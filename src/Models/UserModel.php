<?php
    declare(strict_types=1);
    namespace App\Models;

    use PDO;

    class UserModel {
        public static function insert(array $data): bool {
            global $pdo;

            $stmt = $pdo->prepare("
                INSERT INTO \"user\" (name, email, password, role)
                VALUES (:name, :email, :password, :role)
            ");

            return $stmt->execute([
                ':name'     => $data['name'],
                ':email'    => $data['email'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
                ':role'     => $data['role'] ?? 'Manager'
            ]);
        }

        public static function fetch(array $criteria): array {
            global $pdo;

            if (empty($criteria['email'])) {
                return [];
            }

            $stmt = $pdo->prepare("SELECT * FROM \"user\" WHERE email = :email");
            $stmt->execute([':email' => $criteria['email']]);

            return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
        }

        public static function fetchById(int $id): array|false {
            global $pdo;

            $stmt = $pdo->prepare("SELECT * FROM \"user\" WHERE id = :id");
            $stmt->execute([':id' => $id]);

            return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
        }

        public static function fetchByEmail(string $email): array|false {
            global $pdo;

            $stmt = $pdo->prepare("SELECT * FROM \"user\" WHERE email = :email");
            $stmt->execute([':email' => $email]);

            return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
        }

        public static function update(array $data): bool {
            global $pdo;

            $stmt = $pdo->prepare("
                UPDATE \"user\"
                SET name = :name,
                    email = :email,
                    password = :password,
                    role = :role
                WHERE id = :id
            ");

            return $stmt->execute([
                ':name'     => $data['name'],
                ':email'    => $data['email'],
                ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
                ':role'     => $data['role'],
                ':id'       => $data['id']
            ]);
        }
    }
?>