<?php
namespace App\Services;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ConfirmationMail {
    private static function sendMail(string $to, string $subject, string $body): bool {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['SMTP_USER'];
            $mail->Password   = $_ENV['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $_ENV['SMTP_PORT'];

            $mail->setFrom('no-reply@taskforge.com', 'TaskForge');
            $mail->addAddress($to);

            $mail->isHTML(false);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Mail Error: " . $mail->ErrorInfo);
            return false;
        }
    }

    public static function userCreationMail(string $email, string $name): bool {
        $subject = "Welcome to TaskForge, $name!";
        $body = "Hi $name,\n\nYour account has been successfully created.\nYou can now log in and start managing your tasks.\n\nCheers,\nTaskForge Team";
        return self::sendMail($email, $subject, $body);
    }

    public static function employeeAdded(string $managerName, string $employeeEmail, string $password): bool {
        $subject = "Added to $managerName's Roster";
        $body = "Hello,\n\nYou have been successfully added to $managerName's employee roster.\nYou can now sign in and view your assigned tasks using the following password:\nPassword: $password\n\nRegards,\nTaskForge Team";
        return self::sendMail($employeeEmail, $subject, $body);
    }
}
?>