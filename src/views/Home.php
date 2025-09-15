<?php ob_start(); ?>
<main class="flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">
  <div class="max-w-4xl mx-auto text-center">
    <h1 class="text-5xl md:text-6xl font-extrabold text-white leading-tight mb-4 animate-fade-in-up">
      <span class="block">Welcome to</span>
      <span class="block text-blue-500 mt-2">TaskForge</span>
    </h1>
    <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-2xl mx-auto animate-fade-in">
      TaskForge is your all-in-one task management system for teams and individuals.
      Track assignments, manage employees, and streamline your workflow—all in one place.
    </p>
    <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4 mb-16">
      <a href="/dashboard" class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-white font-semibold rounded-full bg-blue-600 hover:bg-blue-700 transition duration-300 transform hover:scale-105 shadow-lg">
        <span class="absolute inset-0 bg-blue-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
        <span class="relative">Go to Dashboard</span>
      </a>
      <a href="/employees" class="group relative inline-flex items-center justify-center px-8 py-3 overflow-hidden text-gray-300 font-semibold rounded-full border border-gray-600 hover:border-gray-500 transition duration-300 transform hover:scale-105">
        <span class="absolute inset-0 bg-gray-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
        <span class="relative">View Employees</span>
      </a>
    </div>
    <div class="mt-20 text-center">
      <p class="text-sm text-gray-500">
        Built with <span class="text-red-500">🧑‍💻</span> by <a href="https://github.com/externalPointerVariable" class="text-blue-500 font-semibold hover:underline">
  Abhishek Thakur
</a>
      </p>
    </div>
  </div>
</main>
<?php
  $content = ob_get_clean();
  require __DIR__ . '/Layout.php';
?>