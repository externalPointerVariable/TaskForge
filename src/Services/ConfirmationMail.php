<?php
    namespace App\Services;

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class ConfirmationMail {
        private static function sendMail(string $to, string $subject, string $body): bool {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = $_ENV['SMTP_HOST'] ?? 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = $_ENV['SMTP_USER'] ?? '';
                $mail->Password   = $_ENV['SMTP_PASS'] ?? '';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = (int) ($_ENV['SMTP_PORT'] ?? 587);

                $mail->setFrom($_ENV['SMTP_USER'] ?? 'no-reply@taskforge.com', 'TaskForge');
                $mail->addAddress($to);

                $mail->isHTML(false);
                $mail->Subject = $subject;
                $mail->Body    = $body;

                return $mail->send();
            } catch (Exception $e) {
                error_log("Mail Error: " . $mail->ErrorInfo);
                return false;
            }
        }

        public static function userCreationMail(string $email, string $name): bool {
            $subject = "Welcome to TaskForge, $name!";
            $body = <<<TEXT
    Hi $name,

    Your account has been successfully created.
    You can now log in and start managing your Employees.

    Cheers,
    TaskForge Team
    TEXT;
            return self::sendMail($email, $subject, $body);
        }

        public static function employeeAdded(string $managerName, string $employeeEmail, string $password): bool {
            $subject = "Added to $managerName's Roster";
            $body = <<<TEXT
    Hello,

    You have been successfully added to $managerName's employee roster.
    You can now sign in and view your assigned tasks using the following password:
    Password: $password

    Regards,
    TaskForge Team
    TEXT;
            return self::sendMail($employeeEmail, $subject, $body);
        }
    }
?>