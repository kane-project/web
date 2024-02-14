<?php

    require_once("lib/Users.php");

    $userid = decryptUserID($suid);
    $user = new User($userid);

    if($user->id == null || $user->is_email_verified)
        die(header("Location: /account/login"));

    send_verification_email($user);
    die(header("Location: /account/login?ess=1"));

?>