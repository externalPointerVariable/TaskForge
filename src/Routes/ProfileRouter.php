<?php
    use App\Controllers\UserProfileController;

    class ProfileRouter {
        public static function routes(): array {
            return [
                'GET /profile'         => fn() => (new UserProfileController)->index(),
                'POST /profile/update' => fn() => (new UserProfileController)->update($_POST),
            ];
        }
    }

    return ProfileRouter::routes();
?>