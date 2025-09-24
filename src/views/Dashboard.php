<?php ob_start(); ?>
<?php
$role = $_SESSION['user']['role'] ?? null;
$tasks = $data['tasks'] ?? [];
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
            'Pending'     => 'bg-red-600',
            default       => 'bg-gray-400'
          };
        ?>
          <li class="task-card p-6 rounded-lg shadow-lg border border-gray-700 bg-gray-800/70 backdrop-blur-sm transition duration-300 transform hover:scale-[1.02] cursor-pointer"
            data-id="<?= htmlspecialchars($task['id']) ?>"
            data-title="<?= htmlspecialchars($task['title']) ?>"
            data-description="<?= htmlspecialchars($task['description'] ?? 'No description provided.') ?>"
            data-assigned-to="<?= htmlspecialchars($task['assigned_to']) ?>"
            data-status="<?= htmlspecialchars($task['status']) ?>">
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

<div id="task-detail-modal" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50 hidden">
  <div class="bg-gray-800 p-8 rounded-xl shadow-2xl w-full max-w-lg border border-gray-700">
    <div class="flex justify-between items-center mb-6">
      <h3 id="modal-task-title" class="text-2xl font-bold text-white"></h3>
      <button class="close-modal text-gray-400 hover:text-white text-3xl font-light leading-none">&times;</button>
    </div>

    <div class="space-y-4 text-gray-300 mb-6">
      <div>
        <p class="text-sm font-semibold text-gray-400">Assigned To:</p>
        <p id="modal-task-assigned-to" class="font-medium text-white"></p>
      </div>
      <div>
        <p class="text-sm font-semibold text-gray-400">Status:</p>
        <p id="modal-task-status" class="font-medium text-white"></p>
      </div>
      <div>
        <p class="text-sm font-semibold text-gray-400">Description:</p>
        <p id="modal-task-description" class="leading-relaxed"></p>
      </div>
    </div>

    <form id="update-status-form" action="<?= htmlspecialchars($_ENV['BASE_URL'] . '/dashboard/update') ?>"method="POST" class="space-y-4">
      <input type="hidden" id="task-id-input" name="id">
      <div>
        <label for="new-status" class="block text-gray-300 font-medium mb-2">Update Status</label>
        <select id="new-status" name="status" class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="In Progress">In Progress</option>
          <option value="Completed">Completed</option>
          <option value="Pending">Pending</option>
        </select>
      </div>
      <div class="flex justify-end pt-2">
        <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-700 transition duration-300">
          Save Changes
        </button>
      </div>
    </form>
  </div>
</div>

<script>
$(document).ready(function() {
  const taskDetailModal = $('#task-detail-modal');
  const closeModalBtn = $('.close-modal');

  $('.task-card').on('click', function() {
    const taskData = {
      id: $(this).data('id'),
      title: $(this).data('title'),
      description: $(this).data('description'),
      assignedTo: $(this).data('assigned-to'),
      status: $(this).data('status')
    };

    $('#modal-task-title').text(taskData.title);
    $('#modal-task-assigned-to').text(taskData.assignedTo);
    $('#modal-task-status').text(taskData.status);
    $('#modal-task-description').text(taskData.description);
    $('#task-id-input').val(taskData.id);
    $('#new-status').val(taskData.status);

    taskDetailModal.removeClass('hidden');
  });

  closeModalBtn.on('click', function() {
    taskDetailModal.addClass('hidden');
  });

  $(window).on('click', function(event) {
    if ($(event.target).is(taskDetailModal)) {
      taskDetailModal.addClass('hidden');
    }
  });
});
</script>

<?php
  $content = ob_get_clean();
  require __DIR__ . '/Layout.php';
?>