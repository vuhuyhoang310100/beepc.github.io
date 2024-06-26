<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer/Exception.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer/SMTP.php';

class Mailer
{
    public function sendmail($title, $content, $emailaddress, $fullname)
    {

        $mail = new PHPMailer(true);
        $mail->CharSet = 'utf8';
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'vuhuyhoang999123@gmail.com';                 // SMTP username
            $mail->Password = 'wbhg sbdk siqh dgoh';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to
            //Recipients
            $mail->setFrom('vuhuyhoang999123@gmail.com', 'Mailer');
            $mail->addAddress($emailaddress, $fullname);     // Add a recipient
            $mail->addCC('vuhuyhoang999123@gmail.com');
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $title;
            $mail->Body    = $content;
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
