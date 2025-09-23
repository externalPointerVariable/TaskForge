<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TaskForge</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJ+Y3eT+6bJc6RZ9z+U5yExlq6GSYGSHk7tXA=" crossorigin="anonymous"></script>
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
  <header class="py-4">
    <?php include "Navbar.php"; ?>
  </header>

  <main class="max-w-auto mx-auto mt-10">
    <?php echo $content ?? 'Error Loading Content'; ?>
  </main>

</body>
</html>