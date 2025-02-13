<?php
require_once "../vendor/phpmailer/phpmailer/src/Exception.php";
require_once "../vendor/phpmailer/phpmailer/src/PHPMailer.php";
require_once "../vendor/phpmailer/phpmailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class sendMail
{
    private $mail;
    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'tourdemaroc2025@gmail.com';
        $this->mail->Password = 'lcyq bqfk dwnn lypt';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port       = 587;
    }
    public function send($to, $reciever, $subject, $body)
    {
        try {
            $this->mail->setFrom($this->mail->Username, $subject);
            $this->mail->addAddress($to, $reciever);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->send();
            return "Email sent successfully!";
        } catch (Exception $e) {
            echo "Email could not be sent. Error: " . $this->mail->ErrorInfo;
            exit;
        }
    }
}
