<?php ob_start(); ?>
<?php
$role = $_SESSION['user']['role'] ?? null;
$tasks = $data['tasks'] ?? [];

// Example fallback if no tasks are passed
if (empty($tasks)) {
  $tasks = [
    ['title' => 'Design user profile page', 'assigned_to' => 'John Doe', 'status' => 'Completed'],
    ['title' => 'Implement API endpoints', 'assigned_to' => 'Jane Smith', 'status' => 'In Progress'],
    ['title' => 'Fix login form bug', 'assigned_to' => 'Alex Kim', 'status' => 'Overdue'],
    ['title' => 'Write new feature documentation', 'assigned_to' => 'Abhishek Thakur', 'status' => 'Completed']
  ];
}
?>
<div class="py-12 px-4 sm:px-6 lg:px-8">
  <div class="max-w-[1200px] mx-auto">
    <h2 class="text-2xl font-bold text-white mb-6">Assigned <span class="text-blue-500">Tasks</span> 📃</h2>

    <?php if ($role === 'Employee'): ?>
      <ul class="space-y-4">
        <?php foreach ($tasks as $task):
          $statusClass = match ($task['status']) {
            'Completed'   => 'bg-green-600',
            'In Progress' => 'bg-blue-600',
            'Overdue'     => 'bg-red-600',
            default       => 'bg-gray-400'
          };
        ?>
          <li class="p-6 rounded-lg shadow-lg border border-gray-700 bg-gray-800/70 backdrop-blur-sm transition duration-300 transform hover:scale-[1.02]">
            <div class="flex justify-between items-center mb-2">
              <div class="font-bold text-lg text-white"><?= htmlspecialchars($task['title']) ?></div>
              <div class="px-2 py-1 text-xs rounded-full font-semibold text-white <?= $statusClass ?>">
                <?= htmlspecialchars($task['status']) ?>
              </div>
            </div>
            <div class="text-sm text-gray-400">
              Assigned to: <span class="font-medium text-white"><?= htmlspecialchars($task['assigned_to']) ?></span>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <div class="text-center text-gray-400 text-lg mt-12">
        This section is only available to employees. Managers can view their roster <a href="<?= htmlspecialchars($_ENV['BASE_URL']) ?>/employee" class="text-blue-500 hover:underline">here</a>.
      </div>
    <?php endif; ?>
  </div>
</div>
<?php
  $content = ob_get_clean();
  require __DIR__ . '/Layout.php';
?>