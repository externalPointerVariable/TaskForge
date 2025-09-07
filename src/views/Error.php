<?php ob_start(); ?>
<h2 class="text-red-600 font-bold">404 - Page Not Found</h2>
<p><?= htmlspecialchars($message ?? 'Unknown error') ?></p>
<?php
$content = ob_get_clean();
require __DIR__ . '/layout.php';