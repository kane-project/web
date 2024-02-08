<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

    if(delete_listing($id)) 
        die(header("Location: /portal/listings?ds=1"));
    else
        die(header("Location: /portal/listings?de=1"));
    
    die(header("Location: /portal/listings?ds=1"));

?>