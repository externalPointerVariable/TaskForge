<?php
declare(strict_types=1);

class UserModel {
    public static function setUser(string $query): bool {
        // Example: insert user data
        // return $pdo->exec($query);
        return true;
    }

    public static function getUser(string $query): array {
        // Example: fetch user data
        // $stmt = $pdo->query($query);
        // return $stmt->fetchAll(PDO::FETCH_ASSOC);
        return [];
    }

    public static function updateUser(string $query): bool {
        // Example: update user data
        // return $pdo->exec($query);
        return true;
    }
}