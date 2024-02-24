<?php

// cleandelete.php
// Cleanly delete a user account
// Client version

require_once("lib/Users.php");
loadEnv();
session_start();

if (!isset($_SESSION['uid']))
    die(header("Location: /account/login"));

if(!isset($_POST['suid']))
    die(header("Location: /account"));

// Clean Delete Account Here:
// Then redirect to Account Deleted Successfully (post-deletion) page