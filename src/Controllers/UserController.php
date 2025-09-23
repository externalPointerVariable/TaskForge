<?php
    namespace App\Controllers;

    use App\Models\UserModel;
    use App\Services\ConfirmationMail;
    use App\Controllers\UserProfileController;

    class UserController {
        public function getUser(array $credentials): array {
            $email    = trim($credentials['email'] ?? '');
            $password = $credentials['password'] ?? '';

            if (!$email || !$password) {
                return ['view' => 'Login', 'data' => ['message' => 'Email and password are required']];
            }

            $user = UserModel::fetch(['email' => $email]);

            if (!$user || !isset($user['password']) || !password_verify($password, $user['password'])) {
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

            // Check if email already exists
            $existingUser = UserModel::fetch(['email' => $email]);
            if (!empty($existingUser)) {
                return ['view' => 'Register', 'data' => ['message' => 'This email is already registered. Please log in.']];
            }

            $success = UserModel::insert([
                'name'     => $name,
                'email'    => $email,
                'password' => $password, // hashing is done in the model
                'role'     => $role
            ]);

            if ($success) {
                $user = UserModel::fetch(['email' => $email]);

                if ($user && isset($user['id'])) {
                    (new UserProfileController())->createUserProfile([
                        'profile_url' => '',
                        'profession'  => '',
                        'user_id'     => $user['id'],
                        'bio'         => '',
                        'experience'  => '',
                        'salary'      => '',
                        'languages'   => '',
                        'skills'      => ''
                    ]);
                }

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

            if (!$user || !isset($user['password']) || !password_verify($oldPassword, $user['password'])) {
                return ['view' => 'Profile', 'data' => ['message' => 'Incorrect current password']];
            }

            $updated = UserModel::update([
                'id'       => $user['id'],
                'name'     => $user['name'],
                'email'    => $user['email'],
                'password' => $newPassword, // hashing is done in the model
                'role'     => $user['role']
            ]);

            return $updated
                ? ['view' => 'Profile', 'data' => ['message' => 'Password updated successfully']]
                : ['view' => 'Profile', 'data' => ['message' => 'Failed to update password']];
        }
    }
?>