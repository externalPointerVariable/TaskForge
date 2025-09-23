<?php
    use App\Controllers\UserProfileController;

    class ProfileRouter {
        public static function routes(): array {
            return [
                'GET /profile' => function () {
                    $user_id = $_SESSION['user']['id'] ?? null;

                    if (!$user_id || !is_int($user_id)) {
                        return ['view' => 'Error', 'data' => ['message' => 'User not authenticated']];
                    }

                    return (new UserProfileController())->getUserProfile($user_id);
                },

                'POST /profile/update' => fn() => (new UserProfileController())->updateProfile($_POST),
            ];
        }
    }

    return ProfileRouter::routes();
?>