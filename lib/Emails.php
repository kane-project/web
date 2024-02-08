<?php 

// Emails.php
// Manages sending emails to users
// Author: kiduswb

require 'vendor/autoload.php';

/**
 * send_transactional_email
 * Sends a transactional email to a user
 * Connected to Brevo's SMTP server
 * $to_name: Name of the recipient
 * $to_email: Email address of the recipient
 * $subject: Subject of the email
 * $body: Body of the email
 * @return bool
 */
function send_transactional_email($to_name, $to_email, $subject, $body)
{

}