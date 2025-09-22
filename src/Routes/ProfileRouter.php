<?php
    use App\Controllers\UserProfileController;

    class ProfileRouter {
        public static function routes(): array {
            return [
                'GET /profile'         => fn() => (new UserProfileController)->getUserProfile($user_id),
                'POST /profile/update' => fn() => (new UserProfileController)->updateProfile($_POST),
            ];
        }
    }

    return ProfileRouter::routes();
?>