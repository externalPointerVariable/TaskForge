<?php
    namespace App\Controllers;
    use App\Models\UserProfileModel;

    class UserProfileController {
        private array $requiredFields = [
            'profile_url', 'profession', 'user_id', 'bio',
            'experience', 'salary', 'languages', 'skills'
        ];

        private function normalize(array $profile): array {
            return [
                'profession'   => $profile['profession'] ?? 'Not specified',
                'experience'   => $profile['experience'] ?? 'N/A',
                'salary'       => $profile['salary'] ?? 'N/A',
                'languages'    => $profile['languages'] ?? '',
                'skills'       => $profile['skills'] ?? '',
                'bio'          => $profile['bio'] ?? 'No bio available.',
                'profile_url'  => $profile['profile_url'] 
            ];
        }

        private function validate(array $data): ?string {
            foreach ($this->requiredFields as $field) {
                if (empty($data[$field])) {
                    return $field;
                }
            }
            return null;
        }

        public function createUserProfile(array $data): array {
            if ($missing = $this->validate($data)) {
                return ['view' => 'Profile', 'data' => ['message' => "Missing field: $missing"]];
            }

            $success = UserProfileModel::insert($data);

            return $success
                ? ['view' => 'Profile', 'data' => ['message' => 'Profile created successfully']]
                : ['view' => 'Profile', 'data' => ['message' => 'Failed to create profile']];
        }

        public function updateProfile(array $data): array {
            if ($missing = $this->validate($data)) {
                return ['view' => 'Profile', 'data' => ['message' => "Missing field: $missing"]];
            }

            $success = UserProfileModel::upsert($data);

            if (!$success) {
                return ['view' => 'Profile', 'data' => ['message' => 'Failed to update profile']];
            }

            $profile = UserProfileModel::fetch((int)$data['user_id']) ?: [];
            return [
                'view' => 'Profile',
                'data' => [
                    'profile' => $this->normalize($profile),
                    'message' => 'Profile updated successfully'
                ]
            ];
        }

        public function getUserProfile(int $userId): array {
            $profile = UserProfileModel::fetch($userId) ?: [];
            return [
                'view' => 'Profile',
                'data' => ['profile' => $this->normalize($profile)]
            ];
        }
    }
?>