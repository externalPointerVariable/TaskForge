<nav class="text-white">
  <div class="w-4/5 mx-auto flex justify-between items-center bg-gray-800 px-6 py-3 rounded-full shadow-2xl shadow-gray-900/50">

    <div class="text-xl font-bold tracking-wide">
      <a href="<?= htmlspecialchars($_ENV['BASE_URL']) ?>" class="hover:text-gray-300">
        Task<span class="text-blue-500">Forge</span>
      </a>
    </div>

    <ul class="flex space-x-6 text-sm font-medium items-center">
      <?php if (isset($_SESSION['user'])):
        $role = $_SESSION['user']['role'] ?? null;
      ?>

        <?php if ($role === 'Manager'): ?>
          <li>
            <a href="<?= htmlspecialchars($_ENV['BASE_URL'] . '/employee') ?>" class="px-3 py-2 hover:text-blue-300 rounded-full transition duration-150">
              Employees
            </a>
          </li>
        <?php endif; ?>

        <li>
          <a href="<?= htmlspecialchars($_ENV['BASE_URL'] . '/profile') ?>" class="px-3 py-2 hover:text-blue-300 rounded-full transition duration-150">
            Profile
          </a>
        </li>

        <?php if ($role === 'Employee'): ?>
          <li>
            <a href="<?= htmlspecialchars($_ENV['BASE_URL'] . '/dashboard') ?>" class="px-3 py-2 hover:text-blue-300 rounded-full transition duration-150">
              Dashboard
            </a>
          </li>
        <?php endif; ?>

        <li>
          <a href="<?= htmlspecialchars($_ENV['BASE_URL'] . '/login') ?>" class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-full hover:bg-blue-700 transition duration-300">
            Logout
          </a>
        </li>

      <?php else: ?>
        <li>
          <a href="<?= htmlspecialchars($_ENV['BASE_URL'] . '/login') ?>" class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-full hover:bg-blue-700 transition duration-300">
            Login
          </a>
        </li>
        <li>
          <a href="<?= htmlspecialchars($_ENV['BASE_URL'] . '/register') ?>" class="bg-gray-700 text-white font-semibold py-2 px-6 rounded-full hover:bg-gray-600 transition duration-300">
            Register
          </a>
        </li>
      <?php endif; ?>
    </ul>

  </div>
</nav>