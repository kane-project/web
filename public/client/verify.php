<?php

    require_once("lib/Users.php");

    try
    {
        $user = new User($uid);
        
        // If the user is not found, redirect to 404
        if($user->id == null) 
            die(header("Location: /404"));

        // If the user is already verified, redirect to login
        if($user->is_email_verified == 1)
            die(header("Location: /account/login"));

        $user->is_email_verified = 1;
        update_user($user->id, $user);
        die(header("Location: /account/login?vs=1"));
    } 
    catch (Exception $e)
    {
        // fuck it lol
        die(header('Location: /404'));
    }

?>