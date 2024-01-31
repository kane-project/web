<?php

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: login"));

    
?>