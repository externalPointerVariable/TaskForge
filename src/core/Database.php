<?php
    namespace App\Core;

    use PDO;
    use PDOException;

    class Database {
        private PDO $connection;

        public function __construct() {
            try {
                $host     = $_ENV['PGHOST'] ?? 'localhost';
                $port     = $_ENV['DB_PORT'] ?? '5432';
                $dbname   = $_ENV['PGDATABASE'] ?? 'taskforge';
                $user     = $_ENV['PGUSER'] ?? 'postgres';
                $password = $_ENV['PGPASSWORD'] ?? 'your_password';

                $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

                $this->connection = new PDO($dsn, $user, $password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("PostgreSQL connection failed: " . $e->getMessage());
            }
        }

        public function getConnection(): PDO {
            return $this->connection;
        }
    }
?>