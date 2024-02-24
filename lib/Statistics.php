<?php

// Statistics.php
// Functions for tracking and displaying listing statistics
// Author: kiduswb

class StatPiece
{
    public $listing_id;
    public $is_user;
    public $geoloc;
    public $timestamp;
    
    public function __construct($listing_id = 0)
    {
        if($listing_id != 0) {
            $result = sqlQuery("SELECT * FROM `listing_views` WHERE listing_id = ?", [$listing_id])->fetch(PDO::FETCH_ASSOC);
            if($result) {
                $this->listing_id = $result['listing_id'];
                $this->is_user = $result['is_user'];
                $this->geoloc = $result['geoloc'];
                $this->timestamp = $result['timestamp'];
            }
        }
    }
}

/**
 * add_listing_view
 * Adds a piece of listing statistics to the database
 * @param  StatPiece $statinfo
 * @return bool
 */
function add_listing_view($statinfo) {
    $query = "INSERT INTO `listing_views` (listing_id, is_user, geoloc, timestamp) VALUES (?, ?, ?, ?)";
    $params = [$statinfo->listing_id, $statinfo->is_user, $statinfo->geoloc, $statinfo->timestamp];
    $result = sqlQuery($query, $params);
    if(!$result) return false;
    return true;
}

/**
 * fetch_listing_views
 * Fetches all the view statistics entries for a listing
 * @param  int $listing_id
 * @return array of StatPiece objects
 */
function fetch_listing_views($listing_id) {
    $result = sqlQuery("SELECT * FROM `listing_views` WHERE listing_id = ? ORDER BY timestamp DESC", [$listing_id]);
    $views = [];
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $view = new StatPiece();
        $view->listing_id = $row['listing_id'];
        $view->is_user = $row['is_user'];
        $view->geoloc = $row['geoloc'];
        $view->timestamp = $row['timestamp'];
        $views[] = $view;
    }
    return $views;
}

/**
 * fetch_view_count
 * Fetches the view count for a listing
 * @param  int $listing_id
 * @return int view count
 */
function fetch_view_count($listing_id) {
    $result = sqlQuery("SELECT COUNT(*) FROM `listing_views` WHERE listing_id = ?", [$listing_id]);
    return $result->fetchColumn();
}