<?php ob_start(); ?>
<main class="min-h-screen p-4 sm:p-6 lg:p-8">
  <div class="max-w-[1200px] mx-auto flex flex-col md:flex-row gap-8">

    <aside class="md:w-1/4 w-full p-6 bg-gray-900 rounded-xl shadow-lg border border-gray-700">
      <h2 class="text-xl font-bold text-gray-200 mb-6">Control Panel</h2>
      <ul class="space-y-6 text-gray-400">
        <li>
          <a href="/employees/dashboard" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-800 transition duration-300 transform hover:scale-105">
            <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
            <div class="flex-1">
              <span class="block font-medium text-white">Employee Dashboard</span>
            </div>
          </a>
        </li>
        <li>
          <a href="/tasks/dashboard" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-800 transition duration-300 transform hover:scale-105">
            <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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
      <h1 class="text-4xl font-extrabold text-white mb-4">Welcome to the Employee Dashboard</h1>
      <p class="text-gray-300 text-lg mb-8">
        Select an option from the sidebar to view employee details or task assignments. This space will dynamically render CRUD forms, task summaries, and progress indicators.
      </p>

      <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
        <div class="flex-1 p-6 rounded-lg shadow-md border-l-4 border-blue-500 bg-gray-700/50 transition duration-300 transform hover:scale-105">
          <h3 class="text-lg font-semibold text-blue-400 mb-2">Total Employees</h3>
          <p class="text-4xl font-extrabold text-blue-200">12</p>
        </div>
        <div class="flex-1 p-6 rounded-lg shadow-md border-l-4 border-green-500 bg-gray-700/50 transition duration-300 transform hover:scale-105">
          <h3 class="text-lg font-semibold text-green-400 mb-2">Active Tasks</h3>
          <p class="text-4xl font-extrabold text-green-200">27</p>
        </div>
      </div>
    </section>

  </div>
</main>
<?php
$content = ob_get_clean();
require __DIR__ . '/Layout.php';
?>