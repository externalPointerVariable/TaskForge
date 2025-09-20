<?php ob_start(); ?>
<main class="flex items-center justify-center p-4">
  <div class="rounded-xl shadow-2xl w-full max-w-md p-8 text-center flex flex-col items-center bg-gray-800/70 backdrop-blur-lg border border-gray-700">
    
    <svg class="w-24 h-24 text-red-500 mb-6" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
      <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2V7zm0 8h2v2h-2v-2z"/>
    </svg>
    
    <div class="text-6xl font-extrabold text-blue-500 mb-2">404</div>

    <p class="text-gray-300 text-lg mb-6">The page you are looking for is not available!</p>

    <a href=<?=$_ENV['BASE_URL'].''?> class="w-full flex justify-center py-3 px-4 rounded-full shadow-sm text-lg font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 transform hover:scale-105">
      Go Back Home
    </a>
  </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/Layout.php';
?>