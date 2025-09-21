<?php
    namespace App\Controllers;
    use App\Models\UserProfileModel;

    class UserProfileController {
        public function createUserProfile(array $data): bool {
            return UserProfileModel::insert([
                'profile_url' => $data['profile_url'],
                'profession'  => $data['profession'],
                'user_id'     => $data['user_id'],
                'bio'         => $data['bio'],
                'experience'  => $data['experience'],
                'salary'      => $data['salary'],
                'languages'   => $data['languages'],
                'skills'      => $data['skills']
            ]);
        }

        public function getUserProfile(int $userId): array|bool {
            return UserProfileModel::fetch(['user_id' => $userId]);
        }

        public function updateProfile(array $data): bool {
            return UserProfileModel::update([
                'profile_url' => $data['profile_url'],
                'profession'  => $data['profession'],
                'user_id'     => $data['user_id'],
                'bio'         => $data['bio'],
                'experience'  => $data['experience'],
                'salary'      => $data['salary'],
                'languages'   => $data['languages'],
                'skills'      => $data['skills']
            ]);
        }
    }
?>