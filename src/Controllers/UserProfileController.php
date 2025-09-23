<?php
    namespace App\Controllers;
    use App\Models\UserProfileModel;

    class UserProfileController {
        public function createUserProfile(array $data): array {
            $required = ['profile_url', 'profession', 'user_id', 'bio', 'experience', 'salary', 'languages', 'skills'];
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    return ['view' => 'Profile', 'data' => ['message' => "Missing field: $field"]];
                }
            }

            $success = UserProfileModel::insert([
                'profile_url' => $data['profile_url'],
                'profession'  => $data['profession'],
                'user_id'     => $data['user_id'],
                'bio'         => $data['bio'],
                'experience'  => $data['experience'],
                'salary'      => $data['salary'],
                'languages'   => $data['languages'],
                'skills'      => $data['skills']
            ]);

            return $success
                ? ['view' => 'Profile', 'data' => ['message' => 'Profile created successfully']]
                : ['view' => 'Profile', 'data' => ['message' => 'Failed to create profile']];
        }

        public function getUserProfile(int $userId): array {
            $profile = UserProfileModel::fetch(['user_id' => $userId]);

            return $profile
                ? ['view' => 'Profile', 'data' => ['profile' => $profile]]
                : ['view' => 'Profile', 'data' => ['message' => 'Profile not found']];
        }

        public function updateProfile(array $data): array {
            $required = ['profile_url', 'profession', 'user_id', 'bio', 'experience', 'salary', 'languages', 'skills'];
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    return ['view' => 'Profile', 'data' => ['message' => "Missing field: $field"]];
                }
            }

            $success = UserProfileModel::update([
                'profile_url' => $data['profile_url'],
                'profession'  => $data['profession'],
                'user_id'     => $data['user_id'],
                'bio'         => $data['bio'],
                'experience'  => $data['experience'],
                'salary'      => $data['salary'],
                'languages'   => $data['languages'],
                'skills'      => $data['skills']
            ]);

            return $success
                ? ['view' => 'Profile', 'data' => ['message' => 'Profile updated successfully']]
                : ['view' => 'Profile', 'data' => ['message' => 'Failed to update profile']];
        }
    }
?>