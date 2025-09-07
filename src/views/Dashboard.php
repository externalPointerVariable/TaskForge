<?php ob_start(); ?>

<h2 class="text-xl font-semibold mb-4">Employee Tasks</h2>
<ul class="space-y-3">
  <?php foreach ($tasks as $task): ?>
    <li class="bg-white p-4 rounded shadow">
      <div class="font-bold"><?= htmlspecialchars($task['title']) ?></div>
      <div class="text-sm text-gray-600">Assigned to: <?= htmlspecialchars($task['assigned_to']) ?></div>
    </li>
  <?php endforeach; ?>
</ul>

<?php
$content = ob_get_clean();
require __DIR__ . '/Layout.php';