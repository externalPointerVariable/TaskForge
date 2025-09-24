<?php
declare(strict_types=1);

// Show errors for debugging
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Controllers\DashboardController;
use App\Models\UserTasksModel;

// ✅ Initialize PDO
global $pdo;
$pdo = (new Database())->getConnection();

// ✅ Simulate session
$_SESSION['user'] = [
    'id' => 1, // Manager ID
    'role' => 'Manager',
    'name' => 'Test Manager'
];

// ✅ Simulate POST data
$postData = [
    'title'        => 'Test Task',
    'description'  => 'This is a test task for assignment',
    'assigned_to'  => 2 // Employee ID
];

// ✅ Run the controller method
$controller = new DashboardController();
$response = $controller->assignTask($postData);

// ✅ Output the result
echo "<h3>📦 Task Assignment Response:</h3><pre>";
print_r($response);
echo "</pre>";

// ✅ Verify task was inserted
$tasks = $controller->listTasksAdmin($_SESSION['user']['id']);
echo "<h3>📋 Tasks Assigned by Manager:</h3><pre>";
print_r($tasks);
echo "</pre>";
?>