<?php
declare(strict_types=1);

// Show errors for debugging
ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Controllers\UserProfileController;
use App\Models\UserProfileModel;

// ✅ Initialize PDO
global $pdo;
$pdo = (new Database())->getConnection();

// ✅ Simulate session
$_SESSION['user'] = [
    'id' => 1,
    'name' => 'Test User'
];

// ✅ Simulate POST data for profile update
$postData = [
    'user_id'     => $_SESSION['user']['id'],
    'profile_url' => '../src/Assets/test-user.png',
    'profession'  => 'Full-Stack Developer',
    'bio'         => 'Building scalable web applications with PHP and JS.',
    'experience'  => '2 years',
    'salary'      => '₹60000',
    'languages'   => 'PHP, JavaScript, SQL',
    'skills'      => 'Laravel, jQuery, REST APIs'
];

// ✅ Run the updateProfile method
$controller = new UserProfileController();
$updateResponse = $controller->updateProfile($postData);

echo "<h3>✅ Profile Update Response:</h3><pre>";
print_r($updateResponse);
echo "</pre>";

// ✅ Run the getUserProfile method
$fetchResponse = $controller->getUserProfile($_SESSION['user']['id']);

echo "<h3>📋 Fetched User Profile:</h3><pre>";
print_r($fetchResponse);
echo "</pre>";
