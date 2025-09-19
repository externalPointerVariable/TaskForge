<?php
declare(strict_types=1);

session_start();
// Error reporting for development
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Config/Bootstrap.php';

use App\Core\Router;
use App\Core\Database;

// Setting up the database
$dbPath = $_ENV['DATABASE_URL'];
$database = new Database($dbPath);
$pdo = $database->getConnection();

// Normalize URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Strip base path from URI using environment variable
$basePath = $_ENV['BASE_URL'] ?? '';
$uri = preg_replace("#^{$basePath}#", '', $uri);

// Route the request
$router = new Router();
$response = $router->handle($uri, $method);

// If response is HTML, render it
if (is_array($response) && isset($response['view'])) {
    $data = $response['data'] ?? [];
    extract($data); // Make variables available to view
    require __DIR__ . '/../src/Views/' . $response['view'] . '.php';
} elseif (is_array($response)) {
    header("Content-Type: application/json");
    echo json_encode($response);
} else {
    echo $response;
}

?>