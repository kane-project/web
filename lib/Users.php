<?php

// Users.php
// This script handles user authentication and management
// Author: kiduswb

require_once("Database.php");
require_once("Utils.php");

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

    function __construct($id = -1) 
    {
        if($id != -1) 
        {
            $user = sqlQuery("SELECT * FROM users WHERE id = ?", [$id])->fetch(PDO::FETCH_OBJ);
            $this->id = $user->id;
            $this->user_type = $user->user_type;
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->email = $user->email;
            $this->password = $user->password;
            $this->phone = $user->phone;
            $this->address = $user->address;
            $this->is_email_verified = $user->is_email_verified;
            $this->profile_photo = $user->profile_photo;
            $this->timestamp = $user->timestamp;
            $this->is_banned = $user->is_banned;
        }
    }
}

/**
 * user_login
 * Authenticates a user
 * @param  string $email
 * @param  string $password
 * @return User | bool
 */
function user_login($email, $password) {
    $email_check = sqlQuery("SELECT * FROM users WHERE email = ?", [$email]);
    
    if($email_check->rowCount() == 0)
        return false;

    else 
    {
        $user = $email_check->fetch(PDO::FETCH_OBJ);
        if(password_verify($password, $user->password))
            return new User($user->id);
        else
            return false;
    }
}

/**
 * register_user
 * Registers a new user
 * @param  User $user
 * @return bool
 */
function register_user($user)
{
       
}

/**
 * upload_user_photo
 * Attempts to upload a user photo
 * @param  mixed $photo
 * @return bool
 */
function upload_user_photo($photo)
{
    //...
}

/**
 * check_email_phone
 * Checks if email or phone number is already in use
 * @param  mixed $email
 * @param  mixed $phone
 * @return bool
 */
function check_email_phone($email, $phone)
{
    //...
}

/**
 * update_user
 * Updates user data
 * @param  int $id
 * @param  User $newdata
 * @return void
 */
function update_user($id, $newdata) {
    //...
}

/**
 * fetch_users
 * Fetches a list of users
 * @param  int $start
 * @param  int $limit
 * @param  int $type
 * @param  int $verified
 * @param  int $banned
 * @return array
 */
function fetch_users($start, $limit, $type, $verified, $banned) {
    //...
}


/**
 * fetch_user_count
 * Fetches the number of registered users based on type, verified status and ban status
 * @param  int $type
 * @param  int $verified
 * @param  int $banned
 * @return void
 */
function fetch_user_count($type, $verified, $banned) {
    //...
}

/**
 * delete_user
 * Cleans up user data
 * @param  mixed $id
 * @return void
 */
function delete_user($id) {
    //...
}