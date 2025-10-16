<?php 
namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Configs\Config;

class Mailer {
    // ✅ Добавлен метод sendOrderMail()
    public static function sendOrderMail(string $email): bool {
        $mail = new PHPMailer(true);

        try {
            // Настройки сервера
            $mail->isSMTP();
            $mail->Host       = 'ssl://smtp.mail.ru';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'v.milevskiy@coopteh.ru';
            $mail->Password   = 'qRbdMaYL6mfuiqcGX38z';
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

            // Настройки письма
            $mail->setFrom('no-reply@barhat-life.ru', 'barhat-life');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Подтверждение заказа';

            // Тело письма
            $mail->Body = "<p>Здравствуйте,</p>";
            $mail->Body .= "<p>Ваш заказ успешно оформлен.</p>";

            return $mail->send();
        } catch (Exception $e) {
            $_SESSION['flash'] = "Ошибка при отправке email: " . $mail->ErrorInfo;
            return false;
        }
    }

    // Метод для подтверждения регистрации
    public static function sendMailUserConfirmation(string $email, string $token, string $username): bool {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'ssl://smtp.mail.ru';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'v.milevskiy@coopteh.ru';
            $mail->Password   = 'qRbdMaYL6mfuiqcGX38z';
            $mail->Port       = 465;
            $mail->CharSet    = 'UTF-8';

            $mail->setFrom('no-reply@barhat-life.ru', 'barhat-life');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Подтверждение регистрации';

            $verification_link = Config::SITE_URL . "/verify/" . $token;
            $mail->Body = "<p>Здравствуйте, {$username}!</p>";
            $mail->Body .= "<p>Подтвердите регистрацию, перейдя по ссылке:<br>";
            $mail->Body .= "<a href='{$verification_link}'>{$verification_link}</a></p>";

            return $mail->send();
        } catch (Exception $e) {
            $_SESSION['flash'] = "Ошибка при отправке email";
            return false;
        }
    }
}