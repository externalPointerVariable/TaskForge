<?php
namespace App\Core;

use PDO;
use PDOException;

class Database {
    private PDO $connection;
    // Neede to changed to postgrs format before pushing it to the production
    public function __construct(string $dbPath) {
        try {
            $this->connection = new PDO("sqlite:" . $dbPath);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("SQLite connection failed: " . $e->getMessage());
        }
    }

    public function getConnection(): PDO {
        return $this->connection;
    }
}