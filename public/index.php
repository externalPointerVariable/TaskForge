<?php
declare(strict_types=1);

// Error reporting for development
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Autoload dependencies
require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap config
require_once __DIR__ . '/../src/Config/bootstrap.php';

use App\Core\Router;

// Normalize URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

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