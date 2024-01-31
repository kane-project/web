<?php

// Users.php
// This script handles user authentication and management
// Author: kiduswb

class User
{
    public $id;
    public $user_type;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $phone;
    public $address;
    public $is_email_verified;
    public $profile_photo;
    public $timestamp;
    public $is_banned;

    function __construct($id = 0) {
        //...
    }
}

function user_login($email, $password) {
    //...
}

function update_user($id, $newdata) {
    //...
}

function fetch_users($start, $limit) {
    //...
}

function fetch_user_count() {
    //...
}

function delete_user($id) {
    //...
}