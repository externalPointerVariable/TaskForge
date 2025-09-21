<?php
    namespace App\Controllers;

    use App\Models\UserModel;

    class UserController {
        public function getUser(array $credentials): array {
            return UserModel::fetch($credentials);
        }

        public function createUser(array $data): bool {
            return UserModel::insert([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => $data['password'],
                'role'     => 'Manager'
            ]);
        }

        public function updatePassword(array $data): bool {
            $user = UserModel::fetch([
                'email'    => $data['email'],
                'password' => $data['old_password']
            ]);

            if (!$user) {
                return false;
            }

            return UserModel::update([
                'id'       => $user['id'],
                'name'     => $user['name'],
                'email'    => $user['email'],
                'password' => $data['new_password'],
                'role'     => $user['role']
            ]);
        }
    }
?>