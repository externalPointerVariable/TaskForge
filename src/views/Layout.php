<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TaskForge</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link rel="shortcut icon" href="../src/Assets/favicon.png" type="image/x-icon">
  <style>
    body {
      background-image: url('../src/Assets/background-image.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
  </style>
</head>
<body class="text-gray-900 min-h-screen">
  <header class="bg-gray-800 bg-opacity-90 text-white px-6 py-4 shadow">
    <?php include "Navbar.php"; ?>
  </header>

  <main class="max-w-auto mx-auto mt-10">
    <?php echo $content ?? 'Error Loading Content'; ?>
  </main>

</body>
</html>