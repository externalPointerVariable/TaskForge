<?php
declare(strict_types=1);

// Show errors for debugging
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Autoload classes
require_once __DIR__ . '/../vendor/autoload.php';

use App\core\Database;
use Dotenv\Dotenv;
use PDOException;

// Load environment variables from project root
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
    $dbPath = $_ENV['DATABASE_URL'] ?? __DIR__ . '/../storage/database.sqlite';
    $database = new Database($dbPath);
    $pdo = $database->getConnection();

    echo "<h2 style='color:green;'>✅ SQLite connection successful.</h2>";
} catch (PDOException $e) {
    echo "<h2 style='color:red;'>❌ Connection failed:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}