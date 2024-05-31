<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;




class EmailService
{
    protected $app_name;
    protected $host;
    protected $port;
    protected $username;
    protected $password;

    function __construct()
    {
        $this->app_name = config('app.name');
        $this->host = config('app.mail_host');
        $this->port = config('app.mail_port');
        $this->username = config('app.mail_username');
        $this->password = config('app.mail_password');
    }

    public function sendMail($emailUser, $nameUser, $isHTML, $message, $subject)
    {
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host       = $this->host;
        $mail->Username   = $this->username;
        $mail->Password   = $this->password;
        $mail->Port       = $this->port;
        $mail->SMTPAuth   = true;
        $mail->Subject = $subject;

        $mail->setFrom($this->app_name, $this->app_name);
        $mail->addReplyTo($this->app_name, $this->app_name);
        $mail->addAddress($emailUser, $nameUser);
        $mail->isHTML($isHTML);
        //$mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();
    }
}
