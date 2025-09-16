<?php ob_start(); ?>
<?php 
// Example tasks array with different statuses
$tasks = [
    ['title' => 'Design user profile page', 'assigned_to' => 'John Doe', 'status' => 'Completed'],
    ['title' => 'Implement API endpoints', 'assigned_to' => 'Jane Smith', 'status' => 'In Progress'],
    ['title' => 'Fix login form bug', 'assigned_to' => 'Alex Kim', 'status' => 'Overdue'],
    ['title' => 'Write new feature documentation', 'assigned_to' => 'Abhishek Thakur', 'status' => 'Completed']
];
?>

<div class="py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-[1200px] mx-auto">
    <h2 class="text-2xl font-bold text-white mb-6">Assigned <span class="text-blue-500">Tasks</span> 📃</h2>
    <ul class="space-y-4">
      <?php foreach ($tasks as $task): 
        // Determine color based on status
        $statusClass = 'bg-gray-400'; // Default
        switch ($task['status']) {
          case 'Completed':
            $statusClass = 'bg-green-600';
            break;
          case 'In Progress':
            $statusClass = 'bg-blue-600';
            break;
          case 'Overdue':
            $statusClass = 'bg-red-600';
            break;
        }
      ?>
        <li class="p-6 rounded-lg shadow-lg border border-gray-700 bg-gray-800/70 backdrop-blur-sm 
                   transition duration-300 transform hover:scale-[1.02]">
          <div class="flex justify-between items-center mb-2">
            <div class="font-bold text-lg text-white"><?= htmlspecialchars($task['title']) ?></div>
            <div class="px-2 py-1 text-xs rounded-full font-semibold text-white <?= $statusClass ?>">
              <?= htmlspecialchars($task['status']) ?>
            </div>
          </div>
          <div class="text-sm text-gray-400">Assigned to: <span class="font-medium text-white"><?= htmlspecialchars($task['assigned_to']) ?></span></div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/Layout.php';
?>