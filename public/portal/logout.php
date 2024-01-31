<?php
    session_start();
    unset($_SESSION['landlord_id']);
    die(header("Location: /portal/login?ls=1"));
?>