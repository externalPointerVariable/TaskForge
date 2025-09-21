<?php
declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Database;
use App\Models\UserProfileModel;

try {
    $pdo = (new Database())->getConnection();
    echo "<h2>🧪 Running UserProfileModel Tests</h2>";

    // Insert test
    $insertSuccess = UserProfileModel::insert([
        'profile_url' => 'https://example.com/abhishek',
        'profession'  => 'Full-stack Developer',
        'user_id'     => 1,
        'bio'         => 'Backend architect with frontend agility.',
        'experience'  => '2 years',
        'salary'      => '6 LPA',
        'languages'   => 'PHP, JavaScript, SQL',
        'skills'      => 'REST APIs, Tailwind, React'
    ]);
    echo $insertSuccess ? "✅ Insert passed<br>" : "❌ Insert failed<br>";

    // Fetch test
    $profile = UserProfileModel::fetch(['user_id' => 1]);
    echo $profile ? "✅ Fetch passed<br>" : "❌ Fetch failed<br>";

    // Update test
    if ($profile) {
        $profile['profession'] = 'Senior Full-stack Developer';
        $profile['salary'] = '8 LPA';
        $updateSuccess = UserProfileModel::update($profile);
        echo $updateSuccess ? "✅ Update passed<br>" : "❌ Update failed<br>";
    }

} catch (PDOException $e) {
    echo "<h2 style='color:red;'>❌ Connection failed:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}
?>