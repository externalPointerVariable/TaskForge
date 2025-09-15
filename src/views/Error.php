<?php ob_start(); ?>
<section class="flex items-center justify-center">
  <div class="bg-white rounded-xl shadow-lg w-full max-w-xl p-8 text-center flex flex-col items-center">
    
    <div class="text-6xl font-extrabold text-orange-500">404</div>

    <img src="https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif"
         alt="Lost caveman animation"
         class="w-auto h-auto mb-6 rounded-lg shadow-md">
    <p class="text-gray-600 mb-6">The page you are looking for is not available!</p>

    <a href="/" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
      Go Back Home
    </a>
  </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/Layout.php';
?>