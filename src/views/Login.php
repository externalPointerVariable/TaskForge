<?php ob_start(); ?>
<main class="flex items-center justify-center p-4">
    <div class="w-full max-w-md p-8 rounded-xl shadow-2xl bg-gray-800/70 backdrop-blur-lg border border-gray-700">
        <h1 class="text-4xl font-extrabold text-white text-center mb-2">
            Log<span class="text-blue-500">in</span>
        </h1>
        <p class="text-gray-400 text-center mb-8">
            to your TaskForge account
        </p>

        <form action=<?=$_ENV['BASE_URL'].'/login'?> method="POST" class="space-y-6">
            <div>
                <label for="email" class="sr-only">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required
                       class="block w-full px-4 py-3 rounded-md border-0 bg-gray-700 text-gray-200 placeholder-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm"
                       placeholder="Email address">
            </div>

            <div>
                <label for="password" class="sr-only">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required
                       class="block w-full px-4 py-3 rounded-md border-0 bg-gray-700 text-gray-200 placeholder-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm"
                       placeholder="Password">
            </div>

            <div class="flex items-center justify-between text-sm">
                <a href="#" class="font-medium text-blue-500 hover:text-blue-400">
                    Forgot your password?
                </a>
            </div>

            <div>
                <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-full shadow-sm text-lg font-bold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-300 transform hover:scale-105">
                    Sign in
                </button>
            </div>
        </form>

        <div class="mt-8 text-center text-sm text-gray-400">
            Don't have an account?
            <a href=<?=$_ENV['BASE_URL'].'/register'?> class="font-medium text-blue-500 hover:text-blue-400">
                Sign up
            </a>
        </div>
    </div>
</main>
<?php 
$content = ob_get_clean();
require __DIR__ .'/Layout.php';
?>