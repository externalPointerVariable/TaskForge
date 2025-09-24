<?php
declare(strict_types=1);

// Enable error reporting
ini_set('display_errors', '1');
error_reporting(E_ALL);

// Autoload classes
require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Models\UserTasksModel;

try {
    // ✅ Initialize PDO
    global $pdo;
    $pdo = (new Database())->getConnection();

    echo "<h2>🧪 Running UserTasksModel Tests</h2>";

    // ✅ Insert test
    $insertData = [
        'title'        => 'Build dashboard layout',
        'description'  => 'Design sidebar navigation and responsive grid.',
        'assigned_to'  => 1,
        'assigned_by'  => 1
    ];
    $insertSuccess = UserTasksModel::insert($insertData);
    echo $insertSuccess ? "✅ Insert passed<br>" : "❌ Insert failed<br>";
    echo "<h3>📨 Inserted Task Data:</h3><pre>";
    print_r($insertData);
    echo "</pre>";

    // ✅ Fetch single task
    $task = UserTasksModel::fetch(2);
    echo $task ? "✅ Fetch single passed<br>" : "❌ Fetch single failed<br>";
    echo "<h3>📦 Fetched Task (ID 1):</h3><pre>";
    print_r($task);
    echo "</pre>";

    // ✅ Fetch all tasks for user
    $tasks = UserTasksModel::fetchAll(2);
    echo $tasks ? "✅ Fetch all passed<br>" : "❌ Fetch all failed<br>";
    echo "<h3>📋 All Tasks Assigned To User #1:</h3><pre>";
    print_r($tasks);
    echo "</pre>";

    // ✅ Update task
    if ($task) {
        $updateData = [
            'id'          => $task['id'],
            'title'       => 'Refactor dashboard layout',
            'description' => 'Improve responsiveness and modularity.',
            'status'      => 'in-progress',
            'assigned_to' => 1,
            'assigned_by' => 1
        ];
        $updateSuccess = UserTasksModel::update($updateData);
        echo $updateSuccess ? "✅ Update passed<br>" : "❌ Update failed<br>";
        echo "<h3>🔧 Updated Task Data:</h3><pre>";
        print_r($updateData);
        echo "</pre>";

        // ✅ Re-fetch updated task
        $updatedTask = UserTasksModel::fetch($task['id']);
        echo "<h3>📦 Re-Fetched Updated Task:</h3><pre>";
        print_r($updatedTask);
        echo "</pre>";
    }

} catch (PDOException $e) {
    echo "<h2 style='color:red;'>❌ Connection failed:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
?>