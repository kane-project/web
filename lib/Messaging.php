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