<?php 

// Messaging.php
// This script handles messaging between prospective tenants and landlords
// Author: kiduswb

require_once("Database.php");
require_once("Utils.php");

class Message
{
    public $message_id;
    public $sender_id;
    public $receiver_id;
    public $listing_id;
    public $timestamp;
    public $content;
    public $is_read;

    public function __construct($id = 0)
    {
        if ($id != 0) {
            // Load the message from the database
        }
    }
}

class MessageThread
{
    
}

/**
 * send_message
 * Sends a message to a user's inbox
 * @param  Message $message
 * @return void
 */
function send_message($message) {
    //..
}

/**
 * fetch_messages
 * Retrieves threads of messages for a user
 * @param  int $user_id
 * @return array
 */
function fetch_messages($user_id) {
    //...
}

/**
 * check_for_initial_inquiry
 * Checks if a user has already sent an initial inquiry to a listing
 * @param  int $user_id
 * @param  int $listing_id
 * @return bool
 */
function check_for_initial_inquiry($user_id, $listing_id) {
    //...
}

/**
 * get_notif_count
 * Returns the number of unread messages for a user
 * @param  int $receiver_id
 * @return void
 */
function get_notif_count($receiver_id) {
    //...
}