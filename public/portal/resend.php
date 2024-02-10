<?php

    require_once("lib/Users.php");

    $userid = decryptUserID($suid);
    $user = new User($userid);

    if($user->id == null || $user->is_email_verified)
        die(header("Location: /portal/login"));

    send_verification_email($user);
    die(header("Location: /portal/login/?ess=1"));

?>