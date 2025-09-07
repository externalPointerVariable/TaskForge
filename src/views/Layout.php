<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TaskForge</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="Assets/css/Main.css" rel="stylesheet">
  <link rel="shortcut icon" href="Assets/favicon.png" type="image/x-icon">
</head>
<body class="bg-gray-100 text-gray-900">
  <header class="bg-white shadow p-4">
    <h1 class="text-2xl font-bold">TaskForge</h1>
  </header>

  <main class="p-6">
    <?php echo $content ?? ''; ?>
  </main>

  <footer>
    <h1>This is Taskforge footer</h1>
  </footer>
</body>
</html>