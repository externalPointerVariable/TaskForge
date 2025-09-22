<?php
ini_set('display_errors', '1');
error_reporting(E_ALL);

use App\Services\ConfirmationMail;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';

// Load environment variables
$dotenvPath = __DIR__ . '/../';
if (file_exists($dotenvPath . '.env')) {
    $dotenv = Dotenv::createImmutable($dotenvPath);
    $dotenv->load();
}

// Test data
$emailTo = 'abhishekthakur004@outlook.com';
$name = 'John Doe';

try {
    echo "📤 Attempting to send welcome email to $emailTo...\n";

    $mailer = new ConfirmationMail();
    $result = $mailer->userCreationMail($emailTo, $name);

    if ($result) {
        echo "✅ Email sent successfully to $emailTo\n";
    } else {
        echo "❌ Mailer returned false — check SMTP credentials, port, and connection\n";
    }
} catch (Throwable $e) {
    echo "❌ Exception occurred: " . $e->getMessage() . "\n";
}
?>