<nav class="bg-gray-800 text-white px-6 py-4 shadow">
  <div class="flex justify-between items-center">
    <div class="text-xl font-bold tracking-wide">
      <a href=<?=$_ENV['BASE_URL'].''?> class="hover:text-gray-300">Task<span class="text-blue-500">Forge</span></a>
    </div>
    <ul class="flex space-x-6 text-sm font-medium">
      <li><a href=<?=$_ENV['BASE_URL'].'/employee'?> class="hover:text-blue-300">Employees</a></li>
      <li><a href=<?=$_ENV['BASE_URL'].'/dashboard'?> class="hover:text-blue-300">Dashboard</a></li>
      <li><a href=<?=$_ENV['BASE_URL'].'/profile'?> class="hover:text-blue-300">Profile</a></li>
      <li><a href=<?=$_ENV['BASE_URL'].'/login'?> class="hover:text-blue-300">Login</a></li>
      <li><a href=<?=$_ENV['BASE_URL'].'/login'?> class="hover:text-blue-300">Logout</a></li>
    </ul>
  </div>
</nav>