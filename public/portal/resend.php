<?php

    require_once("lib/Users.php");

    $userid = decryptUserID($suid);
    $user = new User($userid);

    if($user->id == null || $user->is_email_verified)
        die(header("Location: /portal/login"));

    $mailDetails = new KaneMail;
    $mailDetails->userID = $user->id;
    $mailDetails->previewText = "Confirm your email address.";
    $mailDetails->greeting = "Hello, $user->first_name!";
    $userType = $user->user_type == 1 ? "Property Owner/Manager" : "Prospective Tenant";
    $mailDetails->message = "Thank you for registering with KANE Project as a $userType. Please click the button below to confirm your email address.";
    $mailDetails->buttonText = "Confirm Email";
    $mailDetails->linkForButton = $user->user_type == 1 ? "https://kaneproject.ca/portal/verify-email/$user->id" : "https://kaneproject.ca/verify-email/$user->id";
    $mailDetails->altLink = $mailDetails->linkForButton; // I know, I hate redundancy too
    send_transactional_email($mailDetails, $user->first_name.' '.$user->last_name, $user->email, "Confirm your email address", 'button');

    die(header("Location: /portal/login/?ess=1"));

?>