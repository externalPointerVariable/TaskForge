<?php
    namespace App\Controllers;
    use App\Models\UserModel;
    use App\Services\ConfirmationMail;
    use PDO;

    class UserController {
        public function getUser(array $credentials): array {
            $email    = trim($credentials['email'] ?? '');
            $password = $credentials['password'] ?? '';

            if (!$email || !$password) {
                return ['view' => 'Login', 'data' => ['message' => 'Email and password are required']];
            }

            $user = UserModel::fetch(['email' => $email]);

            if (!$user || !password_verify($password, $user['password'])) {
                return ['view' => 'Login', 'data' => ['message' => 'Invalid credentials']];
            }

            $_SESSION['user'] = $user;
            return ['view' => 'Dashboard', 'data' => ['user' => $user]];
        }

        public function createUser(array $data): array {
            $name     = trim($data['name'] ?? '');
            $email    = trim($data['email'] ?? '');
            $password = $data['password'] ?? '';
            $role     = $data['role'] ?? 'Manager';

            if (!$name || !$email || !$password) {
                return ['view' => 'Register', 'data' => ['message' => 'All fields are required']];
            }

            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $success = UserModel::insert([
                'name'     => $name,
                'email'    => $email,
                'password' => $hashed,
                'role'     => $role
            ]);

            if ($success) {
                ConfirmationMail::userCreationMail($email, $name);
                return ['view' => 'Login', 'data' => ['message' => 'Account created. Please log in.']];
            }

            return ['view' => 'Register', 'data' => ['message' => 'Registration failed. Try again.']];
        }

        public function updatePassword(array $data): array {
            $email       = trim($data['email'] ?? '');
            $oldPassword = $data['old_password'] ?? '';
            $newPassword = $data['new_password'] ?? '';

            if (!$email || !$oldPassword || !$newPassword) {
                return ['view' => 'Profile', 'data' => ['message' => 'All fields are required']];
            }

            $user = UserModel::fetch(['email' => $email]);

            if (!$user || !password_verify($oldPassword, $user['password'])) {
                return ['view' => 'Profile', 'data' => ['message' => 'Incorrect current password']];
            }

            $updated = UserModel::update([
                'id'       => $user['id'],
                'name'     => $user['name'],
                'email'    => $user['email'],
                'password' => password_hash($newPassword, PASSWORD_DEFAULT),
                'role'     => $user['role']
            ]);

            return $updated
                ? ['view' => 'Profile', 'data' => ['message' => 'Password updated successfully']]
                : ['view' => 'Profile', 'data' => ['message' => 'Failed to update password']];
        }
    }
?>