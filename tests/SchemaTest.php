<?php
declare(strict_types=1);

// Show errors for debugging
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Autoload classes
require_once __DIR__ . '/../vendor/autoload.php';

use App\core\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


try {
    $database = new Database();
    $pdo = $database->getConnection();
    echo $pdo->exec("SELECT name FROM sqlite_master WHERE type='table' ORDER BY name;");

} catch (PDOException $e) {
    echo "<h2 style='color:red;'>❌ Connection failed:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
?>