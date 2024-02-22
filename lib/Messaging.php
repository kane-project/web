<?php 

// Messaging.php
// This script handles messaging between prospective tenants and landlords
// Author: kiduswb

require_once("Database.php");
require_once("Utils.php");

const LISTING_DELETED = -1;

/**
 * Message
 * Represents a single message and its properties
 */
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
        if ($id != 0) 
        {
            $msg = sqlQuery("SELECT * FROM messages WHERE message_id = ?", [$id])->fetch(PDO::FETCH_OBJ);
            $this->message_id = $msg->message_id;
            $this->sender_id = $msg->sender_id;
            $this->receiver_id = $msg->receiver_id;
            $this->listing_id = $msg->listing_id;
            $this->timestamp = $msg->timestamp;
            $this->content = $msg->content;
        }
    }

    public function mark_read() 
    {
        $result = sqlQuery("UPDATE messages SET is_read = 1 WHERE message_id = ?", [$this->message_id]);
        return $result;
    }
}

/**
 * MessageThread
 * Represents a thread of messages between two users
 * Messages are ordered by timestamp, in ascending order
 */
class MessageThread
{
    public $user_id;
    public $messages; // a list of Message objects pertaining to this thread
    public $last_message; // Message object, the last message in the thread, is it unread?

    function load_thread() 
    {
        $result = sqlQuery("SELECT * FROM messages WHERE (sender_id = ? OR receiver_id = ?) ORDER BY timestamp ASC", [$this->user_id, $this->user_id]);
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $msg = new Message($row['message_id']);
            $this->messages[] = $msg;
        }

        $this->last_message = end($this->messages);
    }

    public function is_listing_deleted() 
    {
        $listing = new Listing($this->messages[0]->listing_id);
        if($listing->status == LISTING_DELETED) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * fetch_all_threads
 * Fetches all message threads for a given user
 * @param  int $user_id
 * @return array of MessageThread objects
 */
function fetch_all_threads($user_id, $start, $limit) {
    $threads = array();
    $result = sqlQuery("SELECT DISTINCT listing_id FROM messages WHERE sender_id = ? OR receiver_id = ? LIMIT " . intval($start) . ", " . intval($limit), [$user_id, $user_id]);

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $thread = new MessageThread();
        $thread->user_id = $user_id;
        $thread->load_thread();
        $threads[] = $thread;
    }

    usort($threads, function($a, $b) {
        return $a->last_message->timestamp <=> $b->last_message->timestamp;
    });

    return $threads;
}

/**
 * fetch_threads_count
 * Fetches the count of message threads for a given user
 * @param int $user_id The ID of the user
 * @return int The count of message threads
 */
function fetch_threads_count($user_id) {
    $result = sqlQuery("SELECT COUNT(DISTINCT listing_id) AS thread_count FROM messages WHERE sender_id = ? OR receiver_id = ?", [$user_id, $user_id]);
    $thread_count = $result->fetch(PDO::FETCH_COLUMN);
    return $thread_count;
}

/**
 * get_notif_count
 * Fetches the number of unread messages for a given user
 * @param  mixed $user_id
 * @return void
 */
function get_notif_count($user_id) {
    $result = sqlQuery("SELECT COUNT(*) FROM messages WHERE receiver_id = ? AND is_read = 0", [$user_id]);
    return $result->fetch(PDO::FETCH_COLUMN);
}

/**
 * send_message
 * Sends a message to a user
 * @param  mixed $message
 * @return void
 */
function send_message($message) {
    $result = sqlQuery(
        "INSERT INTO messages (message_id, sender_id, receiver_id, listing_id, timestamp, content, is_read) 
        VALUES (?, ?, ?, ?, ?, ?, ?)",
        [
            $message->message_id,
            $message->sender_id,
            $message->receiver_id,
            $message->listing_id,
            $message->timestamp,
            $message->content,
            $message->is_read
        ]
    );
    
    return $result;
}

/**
 * check_initial_inquiry
 * Checks if a user has already inquired about a listing
 * @param  mixed $user_id
 * @param  mixed $listing_id
 * @return bool
 */
function check_initial_inquiry($user_id, $listing_id) {
    $result = sqlQuery("SELECT * FROM messages WHERE sender_id = ? AND listing_id = ?", [$user_id, $listing_id]);
    if($result->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
}
