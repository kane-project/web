<?php 

// Emails.php
// Manages sending emails to users
// Author: kiduswb

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

/**
 * send_transactional_email
 * Sends a transactional email to a user
 * Connected to Brevo's SMTP server
 * $to_name: Name of the recipient
 * $to_email: Email address of the recipient
 * $subject: Subject of the email
 * $body: Body of the email
 * $altbody (optional): Alternative body of the email for non-HTML clients
 * @return bool
 */
function send_transactional_email($name, $to_email, $subject, $body, $altbody = "")
{
    $mail = new PHPMailer(true);
    loadEnv();

    try 
    {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_ENV['SMTP_HOST'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $_ENV['SMTP_USER'];                     //SMTP username
        $mail->Password   = $_ENV['SMTP_PASS'];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = $_ENV['SMTP_PORT'];

        //Recipients
        $mail->setFrom('no-reply@kaneproject.ca', 'KANE Project Notifications');
        $mail->addAddress($to_email, $name);     //Add a recipient
        $mail->addReplyTo('no-reply@kaneproject.ca', 'noreply');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $altbody;

        $mail->send();
        echo 'Message has been sent';
    } 
    
    catch (Exception $e) {
        die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }

    return true;
}