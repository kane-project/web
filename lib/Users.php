<?php

// Users.php
// This script handles user authentication and management
// Author: kiduswb

require_once("Emails.php");
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
    $sql = "INSERT INTO users (id, user_type, first_name, last_name, email, password, phone, address, is_email_verified, profile_photo, timestamp, is_banned) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $result = sqlQuery($sql, [$user->id, $user->user_type, $user->first_name, $user->last_name, $user->email, $user->password, $user->phone, $user->address, $user->is_email_verified, $user->profile_photo, $user->timestamp, $user->is_banned]);

    if(!$result)
        return false;

    $mailDetails = new KaneMail;
    $mailDetails->userID = $user->id;
    $mailDetails->previewText = "Confirm your email address.";
    $mailDetails->greeting = "Hello, $user->first_name!";
    $userType = $user->user_type == 1 ? "Property Owner/Manager" : "Prospective Tenant";
    $mailDetails->message = "Thank you for registering with KANE Project as a $userType. Please click the button below to confirm your email address.";
    $mailDetails->buttonText = "Confirm Email";
    $mailDetails->linkForButton = $user->user_type == 1 ? "https://kaneproject.ca/portal/verify-email/$user->id" : "https://kaneproject.ca/verify-email/$user->id";
    $mailDetails->altLink = $mailDetails->linkForButton; // I know, I hate redundancy too
    send_transactional_email($mailDetails, $user->first_name.' '.$user->last_name, $user->email, "Confirm your email address", 'button');
    return true;
}

/**
 * upload_user_photo
 * Attempts to upload a user photo
 * @param  array $photo
 * @return string
 */
function upload_user_photo($photo)
{
    // Check if file was uploaded without errors
    if(isset($photo) && $photo['error'] === UPLOAD_ERR_OK) {
        $file_tmp_name = $photo['tmp_name'];
        $file_name = generate_uuid() . '.' . pathinfo($photo['name'], PATHINFO_EXTENSION);
        $destination = './uploads/profiles/' . $file_name;
        if(move_uploaded_file($file_tmp_name, $destination)) {
            return $file_name;
        } else {
            return "ERROR"; // Failed to move file
        }
    } else {
        return ""; // No file uploaded or some error occurred
    }
}

/**
 * delete_user_photo
 * Deletes a user photo from storage
 * @param  string $photo The path of the photo to delete
 * @return void
 */
function delete_user_photo($photo) 
{
    unlink("./uploads/profiles/" . $photo);    
}

/**
 * is_email_phone_registered
 * Checks if email or phone number is already in use
 * @param  string $email
 * @param  string $phone
 * @return bool
 */
function is_email_phone_registered($email, $phone)
{
    $result = sqlQuery("SELECT * FROM users WHERE email = ? OR phone = ?", [$email, $phone]);
    if($result->rowCount() == 0)
        return false;
    else
        return true;
}

/**
 * resend_verification_email
 * Resends a verification email
 * @param  User $user
 * @return void
 */
function resend_verification_email($user)
{
    //...
}

/**
 * update_user
 * Updates user data
 * @param  int $id The ID of the user to update
 * @param  User $newdata The new data for the user
 * @return bool True if the update was successful, false otherwise
 */
function update_user($id, $newdata) {
    try {
        // Prepare the SQL query
        $sql = "UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, phone = ?, address = ?, is_email_verified = ?, profile_photo = ?, is_banned = ? WHERE id = ?";
        
        // Prepare the parameters array
        $params = [
            $newdata->first_name,
            $newdata->last_name,
            $newdata->email,
            $newdata->password,
            $newdata->phone,
            $newdata->address,
            $newdata->is_email_verified,
            $newdata->profile_photo,
            $newdata->is_banned,
            $id
        ];

        // Execute the SQL query
        $result = sqlQuery($sql, $params);
        
        // Check if the query was successful
        if ($result->rowCount() > 0) {
            return true; // Return true if at least one row was affected
        } else {
            return false; // Return false if no rows were affected
        }
    } catch (PDOException $e) {
        // Handle database errors
        // You may log the error, display a user-friendly message, or rethrow the exception
        error_log("Error updating user: " . $e->getMessage());
        return false; // Return false to indicate failure
    }
}

#
# Administration Functions, mostly for admin use
#

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
 * ban_user
 * Bans a user
 * @param  mixed $userid
 * @return void
 */
function ban_user($userid) {
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