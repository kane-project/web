<?php
    session_start();
    unset($_SESSION['uid']);
    die(header("Location: /account/login?ls=1"));
?>