<?php
declare(strict_types=1);

// Enable error reporting for development
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Autoload dependencies
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment config
require_once __DIR__ . '/../src/Config/bootstrap.php';

use App\Core\Router;

// Set response headers
header("Content-Type: application/json");

// Initialize router
$router = new Router();

// Handle incoming request
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$router->handle($uri, $method);
?>