<?php
    declare(strict_types=1);

    // Enable error reporting
    ini_set('display_errors', '1');
    error_reporting(E_ALL);

    // Autoload classes
    require_once __DIR__ . '/../vendor/autoload.php';

    use App\Core\Database;
    use App\Models\UserModel;

    try {
        $pdo = (new Database())->getConnection();

        echo "<h2>🔧 Running UserModel Tests</h2>";

        // // Test Insert
        // $insertSuccess = UserModel::insert([
        //     'name' => 'Abhishek Thakur',
        //     'email' => 'abhishek@example.com',
        //     'password' => 'securePass123',
        //     'role' => 'developer'
        // ]);
        // echo $insertSuccess ? "✅ Insert passed<br>" : "❌ Insert failed<br>";

        // Test Fetch
        $user = UserModel::fetch(['email' => 'abhishek@example.com', 'password' => 'newSecurePass456']);
        print_r($user);

        // Test Update
        if ($user) {
            $user['name'] = 'Abhishek Thakur';
            $user['role'] = 'Manager';
            $user['password'] = 'newSecurePass456';

            $updateSuccess = UserModel::update($user);
            echo $updateSuccess ? "✅ Update passed<br>" : "❌ Update failed<br>";
        }

    } catch (PDOException $e) {
        echo "<h2 style='color:red;'>❌ Connection failed:</h2>";
        echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    }

?>