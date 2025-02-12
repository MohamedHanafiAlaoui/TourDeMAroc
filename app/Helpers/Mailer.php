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
        $this->mail->Host = 'smtp.mailersend.net';
        $this->mail->SMTPAuth = true;
        $this->mail->Username = 'MS_FDAAAT@trial-7dnvo4dqqdnl5r86.mlsender.net';
        $this->mail->Password = 'mssp.HPdjwFP.v69oxl5yvox4785k.Alfgvkr';
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mail->Port = 587;
    }
    public function send($to, $subject, $body)
    {
        try {
            $this->mail->setFrom('elhoubiyoussef@gmail.com', 'Your Name');
            $this->mail->addAddress($to, 'Recipient Name');
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->send();
            return "Email sent successfully!";
        } catch (Exception $e) {
            return "Email could not be sent. Error: " . $this->mail->ErrorInfo;
        }
    }
}
