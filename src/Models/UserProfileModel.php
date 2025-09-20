<?php
    declare(strict_types=1);
    namespace App\Models;

    class UserProfileModel{
        public static function insert(array $data): bool {
            global $pdo;

            $stmt = $pdo->prepare(" INSERT INTO user_profile ( profile_url, profession, user_id, bio, experience, salary, languages, skills ) VALUES ( :profile_url, :profession, :user_id, :bio, :experience, :salary, :languages, :skills )");

            return $stmt->execute([
                ':profile_url' => $data['profile_url'],
                ':profession'  => $data['profession'],
                ':user_id'     => $data['user_id'],
                ':bio'         => $data['bio'],
                ':experience'  => $data['experience'],
                ':salary'      => $data['salary'],
                ':languages'   => $data['languages'],
                ':skills'      => $data['skills']
            ]);
        }

        public static function fetch(array $data): bool|array {
            global $pdo;

            $stmt = $pdo->prepare("SELECT * FROM user_profile WHERE user_id = :user_id");
            $stmt->execute([':user_id' => $data['user_id']]);

            $profile = $stmt->fetch(PDO::FETCH_ASSOC);
            return $profile ?: false;
        }

        public static function update(array $data): bool {
            global $pdo;

            $stmt = $pdo->prepare('
                UPDATE user_profile
                SET profile_url = :profile_url,
                    profession  = :profession,
                    bio         = :bio,
                    experience  = :experience,
                    salary      = :salary,
                    languages   = :languages,
                    skills      = :skills
                WHERE user_id = :user_id
            ');

            return $stmt->execute([
                ':profile_url' => $data['profile_url'],
                ':profession'  => $data['profession'],
                ':bio'         => $data['bio'],
                ':experience'  => $data['experience'],
                ':salary'      => $data['salary'],
                ':languages'   => $data['languages'],
                ':skills'      => $data['skills'],
                ':user_id'     => $data['user_id']
            ]);
        }
    }
?>