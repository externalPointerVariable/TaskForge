<?php
    use App\Controllers\UserProfileController;

    class ProfileRouter {
        public static function routes(): array {
            return [
                'GET /profile' => function () {
                    $user = $_SESSION['user'] ?? null;
                    $userId = isset($user['id']) ? (int) $user['id'] : null;

                    if (!$userId) {
                        return ['view' => 'Error', 'data' => ['message' => 'User not authenticated']];
                    }

                    $controller = new UserProfileController();
                    $response = $controller->getUserProfile($userId);

                    return $response;
                },
                'POST /profile/update' => fn() => (new UserProfileController())->updateProfile($_POST),
            ];
        }
    }

    return ProfileRouter::routes();
?>