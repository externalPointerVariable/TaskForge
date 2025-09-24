<?php ob_start(); ?>
<?php
$role = $_SESSION['user']['role'] ?? null;
$base = htmlspecialchars($_ENV['BASE_URL']);
$employees = [];
$tasks = [];

if ($role === 'Manager') {
    $employees = $data['employees'] ?? [];
    $tasks     = $data['tasks'] ?? [];
}
?>
<main class="p-4 sm:p-6 lg:p-8">
  <div class="max-w-[1200px] mx-auto flex flex-col md:flex-row gap-8">

    <aside class="md:w-1/4 w-full p-6 bg-gray-900 rounded-xl shadow-lg border border-gray-700">
      <h2 class="text-xl font-bold text-gray-200 mb-6">Control Panel</h2>
      <ul class="space-y-6 text-gray-400">
        <li>
          <a href="#" class="toggle-section flex items-center gap-3 p-3 rounded-lg hover:bg-gray-800 transition duration-300 transform hover:scale-105" data-target="employees-section">
            <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
            <div class="flex-1">
              <span class="block font-medium text-white">Employee Dashboard</span>
            </div>
          </a>
        </li>
        <li>
          <a href="#" class="toggle-section flex items-center gap-3 p-3 rounded-lg hover:bg-gray-800 transition duration-300 transform hover:scale-105" data-target="tasks-section">
            <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24">
              <path d="M19 3h-4.18C14.4 1.84 13.3 1 12 1s-2.4.84-2.82 2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 0c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm2 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/>
            </svg>
            <div class="flex-1">
              <span class="block font-medium text-white">Task Dashboard</span>
            </div>
          </a>
        </li>
      </ul>
    </aside>

    <section class="md:w-3/4 w-full p-8 bg-gray-800/50 backdrop-blur-sm rounded-xl shadow-lg border border-gray-700">
      <?php if ($role === 'Manager'): ?>
        <div id="employees-section" class="space-y-6">
          <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Employee Management</h1>
            <button id="add-employee-btn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
              + Add Employee
            </button>
          </div>
          
          <div class="bg-gray-900 rounded-lg p-4">
            <h3 class="text-xl font-semibold text-gray-200 mb-4">Employee List</h3>
            <ul class="space-y-3 text-gray-300">
              <?php foreach ($employees as $employee): ?>
                <li class="flex justify-between items-center p-3 bg-gray-800 rounded-lg border border-gray-700">
                  <div>
                    <span class="block font-medium text-white"><?= htmlspecialchars($employee['name']) ?></span>
                    <span class="block text-sm text-gray-400"><?= htmlspecialchars($employee['email']) ?></span>
                  </div>
                  <div class="flex gap-2">
                    <button class="text-sm text-blue-400 hover:text-blue-300">Edit</button>
                    <button class="text-sm text-red-400 hover:text-red-300">Remove</button>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>

        <div id="tasks-section" class="space-y-6 hidden">
          <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Task Management</h1>
            <button id="assign-task-btn" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300">
              + Assign Task
            </button>
          </div>
          
          <div class="bg-gray-900 rounded-lg p-4">
            <h3 class="text-xl font-semibold text-gray-200 mb-4">Task List</h3>
            <ul class="space-y-3 text-gray-300">
              <?php foreach ($tasks as $task): ?>
                <li class="p-4 bg-gray-800 rounded-lg border border-gray-700">
                  <h4 class="text-white text-lg font-semibold"><?= htmlspecialchars($task['title']) ?></h4>
                  <p class="text-gray-400 text-sm mt-1"><?= htmlspecialchars($task['description']) ?></p>
                  <span class="block mt-2 text-xs text-green-400">Assigned to: <?= htmlspecialchars($task['assigned_to']) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>

        <div id="add-employee-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
          <div class="bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md border border-gray-700">
            <div class="flex justify-between items-center mb-4">
              <h3 class="text-xl font-bold text-white">Add New Employee</h3>
              <button class="close-modal text-gray-400 hover:text-white">&times;</button>
            </div>
            <form action="<?= $base ?>/employee/add" method="POST">
              <div class="mb-4">
                <label for="fullName" class="block text-gray-300 mb-2">Full Name</label>
                <input type="text" id="fullName" name="fullName"
                  class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required>
              </div>

              <div class="mb-4">
                <label for="email" class="block text-gray-300 mb-2">Email</label>
                <input type="email" id="email" name="email"
                  class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required>
              </div>

              <div class="mb-6">
                <label for="password" class="block text-gray-300 mb-2">Password</label>
                <input type="password" id="password" name="password"
                  class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required>
              </div>

              <div class="flex justify-end">
                <button type="submit"
                  class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                  Add Employee
                </button>
              </div>
            </form>
          </div>
        </div>

        <div id="assign-task-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
          <div class="bg-gray-800 p-6 rounded-lg shadow-xl w-full max-w-md border border-gray-700">
            <div class="flex justify-between items-center mb-4">
              <h3 class="text-xl font-bold text-white">Assign New Task</h3>
              <button class="close-modal text-gray-400 hover:text-white">&times;</button>
            </div>
            <form action="<?= $base ?>/assign" method="POST">
              <div class="mb-4">
                <label for="taskTitle" class="block text-gray-300 mb-2">Title</label>
                <input type="text" id="taskTitle" name="taskTitle"
                  class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                  required>
              </div>

              <div class="mb-4">
                <label for="taskDescription" class="block text-gray-300 mb-2">Description</label>
                <textarea id="taskDescription" name="taskDescription" rows="4"
                  class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                  required></textarea>
              </div>

              <div class="mb-6">
                <label for="assignedTo" class="block text-gray-300 mb-2">Assigned To</label>
                <select id="assignedTo" name="assignedTo"
                  class="w-full p-3 bg-gray-900 rounded-lg border border-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-green-500"
                  required>
                  <?php foreach ($employees as $employee): ?>
                    <option value="<?= htmlspecialchars($employee['email']) ?>">
                      <?= htmlspecialchars($employee['name']) ?>
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="flex justify-end">
                <button type="submit"
                  class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                  Assign Task
                </button>
              </div>
            </form>
          </div>
        </div>

        <script>
          $(document).ready(function () {
            const employeesSection = $('#employees-section');
            const tasksSection = $('#tasks-section');
            const employeesToggle = $('[data-target="employees-section"]');
            const tasksToggle = $('[data-target="tasks-section"]');

            const addEmployeeBtn = $('#add-employee-btn');
            const addEmployeeModal = $('#add-employee-modal');
            const assignTaskBtn = $('#assign-task-btn');
            const assignTaskModal = $('#assign-task-modal');
            const closeModalBtns = $('.close-modal');

            employeesSection.show();
            tasksSection.hide();

            employeesToggle.on('click', function (e) {
              e.preventDefault();
              employeesSection.show();
              tasksSection.hide();
            });

            tasksToggle.on('click', function (e) {
              e.preventDefault();
              tasksSection.show();
              employeesSection.hide();
            });

            // Handle Modal Opening
            addEmployeeBtn.on('click', function () {
              addEmployeeModal.removeClass('hidden');
            });

            assignTaskBtn.on('click', function () {
              assignTaskModal.removeClass('hidden');
            });

            closeModalBtns.on('click', function () {
              $(this).closest('.fixed').addClass('hidden');
            });

            $(document).on('click', function(e) {
              if (e.target.id === 'add-employee-modal' || e.target.id === 'assign-task-modal') {
                $(e.target).addClass('hidden');
              }
            });
          });
        </script>
      <?php else: ?>
        <div class="text-center text-gray-400 text-lg mt-12">
          This dashboard is reserved for managers. If you're an employee, please visit your <a href="<?= $base ?>/dashboard" class="text-blue-500 hover:underline">task dashboard</a>.
        </div>
      <?php endif; ?>
    </section>

  </div>
</main>
<?php
  $content = ob_get_clean();
  require __DIR__ . '/Layout.php';
?>