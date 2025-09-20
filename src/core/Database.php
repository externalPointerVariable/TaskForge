<?php

    namespace App\Core;

    use PDO;
    use PDOException;

    class Database {
        private PDO $connection;

        public function __construct() {
            try {
                $this->connection = new PDO('sqlite:' . $_ENV['DATABASE_URL']);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("SQLite connection failed: " . $e->getMessage());
            }
        }

        public function getConnection(): PDO {
            return $this->connection;
        }
    }
?>