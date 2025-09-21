<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Models\UserTasksModel;

try {
    $pdo = (new Database())->getConnection();
    echo "<h2>🧪 Running UserTasksModel Tests</h2>";

    // Insert test
    $insertSuccess = UserTasksModel::insert([
        'title'        => 'Build dashboard layout',
        'description'  => 'Design sidebar navigation and responsive grid.',
        'assigned_to'  => 1
    ]);
    echo $insertSuccess ? "✅ Insert passed<br>" : "❌ Insert failed<br>";

    // Fetch single task
    $task = UserTasksModel::fetch(1);
    echo $task ? "✅ Fetch single passed<br>" : "❌ Fetch single failed<br>";

    // Fetch all tasks for user
    $tasks = UserTasksModel::fetchAll(1);
    echo $tasks ? "✅ Fetch all passed<br>" : "❌ Fetch all failed<br>";

    // Update task
    if ($task) {
        $updateSuccess = UserTasksModel::update([
            'id'          => $task['id'],
            'title'       => 'Refactor dashboard layout',
            'description' => 'Improve responsiveness and modularity.',
            'status'      => 'in-progress',
            'assigned_to' => 1
        ]);
        echo $updateSuccess ? "✅ Update passed<br>" : "❌ Update failed<br>";
    }

} catch (PDOException $e) {
    echo "<h2 style='color:red;'>❌ Connection failed:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}