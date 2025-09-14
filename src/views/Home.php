<?php ob_start(); ?>
<section class="bg-white rounded-lg shadow p-8 max-w-3xl mx-auto mt-10">
  <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Welcome to TaskForge</h1>
  <p class="text-lg text-gray-700 mb-6">
    TaskForge is your all-in-one task management system for teams and individuals. Track assignments, manage employees, and streamline your workflow—all in one place.
  </p>
  <div class="flex space-x-4">
    <a href="/dashboard" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
      Go to Dashboard
    </a>
    <a href="/employees" class="bg-gray-200 text-gray-800 px-6 py-2 rounded hover:bg-gray-300 transition">
      View Employees
    </a>
  </div>
</section>

<section class="mt-16 text-center text-gray-600">
  <p class="text-sm">Built with ❤️ by Abhishek Thakur</p>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';