<?php ob_start(); ?>
<section class="flex items-center justify-center px-6 py-12">
  <div class="bg-white bg-opacity-90 backdrop-blur-md rounded-xl shadow-xl max-w-md w-full p-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Create Your <span class="text-blue-500">Account</span></h1>

    <form action="/register" method="POST" class="space-y-4">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" id="name" name="name" required
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
        <input type="email" id="email" name="email" required
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
      </div>

      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input type="password" id="password" name="password" required
               class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition font-semibold">
        Register
      </button>
    </form>

    <p class="mt-6 text-sm text-center text-gray-600">
      Already have an account?
      <a href="/login" class="text-blue-600 hover:underline">Log in</a>
    </p>
  </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/Layout.php';
?>