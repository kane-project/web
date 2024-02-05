<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

    // Move data to kanetrash_db

    // Move photos to kanetrash_s3

    // Delete Listing Photos from local server

    // Delete Listing Data from local server

    // Redirect to listings list

    die(header("Location: /portal/listings?ds=1"));

?>