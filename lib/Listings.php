<?php

// Listings.php
// This script handles listing management
// Author: kiduswb

require_once("Database.php");

class Listing
{

    public $id;
    public $userid;
    public $slug;
    public $title;
    public $address;
    public $description;
    public $rental_type;
    public $price;
    public $num_beds;
    public $num_baths;
    public $is_furnished;
    public $allows_pets;
    public $has_parking;
    public $timestamp;
    public $view_count;
    public $sponsored_tier;

    function __construct($id = null) 
    {
        
        if ($id != null) {
            $result = sqlQuery("SELECT * FROM `listings` WHERE id = ?", [$id])->fetch(PDO::FETCH_ASSOC);
            if ($result != null){
                $this->id = $result['id'];
                $this->userid = $result['userid'];
                $this->slug = $result['slug'];
                $this->title = $result['title'];
                $this->address = $result['address'];
                $this->description = $result['description'];
                $this->rental_type = $result['rental_type'];
                $this->price = $result['price'];
                $this->num_beds = $result['num_beds'];
                $this->num_baths = $result['num_baths'];
                $this->is_furnished = $result['is_furnished'];
                $this->allows_pets = $result['allows_pets'];
                $this->has_parking = $result['has_parking'];
                $this->timestamp = $result['timestamp'];
                $this->view_count = $result['view_count'];
                $this->sponsored_tier = $result['sponsored_tier'];
            }
        }
    }
}

/**
 * fetch_listings
 * Fetches listings from the database
 * @param  array $filters
 * @param  int $start
 * @param  int $limit
 * @return array
 */
function fetch_listings($filters) 
{
    // $filters is an array of filters with the following optional keys:
    // - type: the rental type of the listing - {apartment, room, house, condo, townhouse, studio, loft, basement, other}
    // - min_price: the minimum price of the listing
    // - max_price: the maximum price of the listing
    // - min_bedrooms: the minimum number of bedrooms
    // - max_bedrooms: the maximum number of bedrooms
    // - min_bathrooms: the minimum number of bathrooms
    // - max_bathrooms: the maximum number of bathrooms
    // - user_id: the id of the user who created the listing
    // - is_furnished: whether the listing is furnished
    // - has_parking: whether the listing has parking
    // - allows_pets: whether the listing allows pets

    $sql_query_string = "SELECT * FROM listings WHERE 1=1";

    if (isset($filters['type'])) {
        $sql_query_string .= " AND type = " . $filters['type'];
    }

    if (isset($filters['min_price'])) {
        $sql_query_string .= " AND price >= " . $filters['min_price'];
    }

    if (isset($filters['max_price'])) {
        $sql_query_string .= " AND price <= " . $filters['max_price'];
    }

    if (isset($filters['min_bedrooms'])) {
        $sql_query_string .= " AND bedrooms >= " . $filters['min_bedrooms'];
    }

    if (isset($filters['max_bedrooms'])) {
        $sql_query_string .= " AND bedrooms <= " . $filters['max_bedrooms'];
    }

    if (isset($filters['min_bathrooms'])) {
        $sql_query_string .= " AND bathrooms >= " . $filters['min_bathrooms'];
    }

    if (isset($filters['max_bathrooms'])) {
        $sql_query_string .= " AND bathrooms <= " . $filters['max_bathrooms'];
    }

    if (isset($filters['user_id'])) {
        $sql_query_string .= " AND userid = " . $filters['user_id'];
    }

    if (isset($filters['is_furnished'])) {
        $sql_query_string .= " AND is_furnished = " . $filters['is_furnished'];
    }

    if (isset($filters['has_parking'])) {
        $sql_query_string .= " AND has_parking = " . $filters['has_parking'];
    }

    if (isset($filters['allows_pets'])) {
        $sql_query_string .= " AND allows_pets = " . $filters['allows_pets'];
    }

    // Proritize Sponsored Listings
    // Sort by timestamp

    $sql_query_string .= " ORDER BY timestamp DESC, sponsored_tier DESC";
    $result = sqlQuery($sql_query_string);

    $listings = [];
    $rows = $result->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($rows as $row) 
    {
        $listing = new Listing($row['id']);
        $listings[] = $listing;
    }

    return $listings;
}

/**
 * fetch_listings_count
 * Fetches the count of listings from the database
 * @param  array $filters
 * @return int
 */
function fetch_listings_count($filters) 
{
    $sql_query_string = "SELECT COUNT(*) AS count FROM listings WHERE 1=1";

    if (isset($filters['type'])) {
        $sql_query_string .= " AND type = " . $filters['type'];
    }

    if (isset($filters['min_price'])) {
        $sql_query_string .= " AND price >= " . $filters['min_price'];
    }

    if (isset($filters['max_price'])) {
        $sql_query_string .= " AND price <= " . $filters['max_price'];
    }

    if (isset($filters['min_bedrooms'])) {
        $sql_query_string .= " AND bedrooms >= " . $filters['min_bedrooms'];
    }

    if (isset($filters['max_bedrooms'])) {
        $sql_query_string .= " AND bedrooms <= " . $filters['max_bedrooms'];
    }

    if (isset($filters['min_bathrooms'])) {
        $sql_query_string .= " AND bathrooms >= " . $filters['min_bathrooms'];
    }

    if (isset($filters['max_bathrooms'])) {
        $sql_query_string .= " AND bathrooms <= " . $filters['max_bathrooms'];
    }

    if (isset($filters['user_id'])) {
        $sql_query_string .= " AND userid = " . $filters['user_id'];
    }

    if (isset($filters['is_furnished'])) {
        $sql_query_string .= " AND is_furnished = " . $filters['is_furnished'];
    }

    if (isset($filters['has_parking'])) {
        $sql_query_string .= " AND has_parking = " . $filters['has_parking'];
    }

    if (isset($filters['allows_pets'])) {
        $sql_query_string .= " AND allows_pets = " . $filters['allows_pets'];
    }

    $result = sqlQuery($sql_query_string);
    return $result->fetch()['count'];
}

/**
 * add_listing
 * Adds a new listing to the database
 * @param  Listing $listing
 * @return bool
 */
function add_listing($listing) 
{
    $result = sqlQuery("INSERT INTO `listings` VALUES (
        :id,
        :userid,
        :slug,
        :title,
        :address,
        :description,
        :rental_type,
        :price,
        :num_beds,
        :num_baths,
        :is_furnished,
        :allows_pets,
        :has_parking,
        :timestamp,
        :view_count,
        :sponsored_tier
    )", [
        ':id' => $listing->id,
        ':userid' => $listing->userid,
        ':slug' => $listing->slug,
        ':title' => $listing->title,
        ':address' => $listing->address,
        ':description' => $listing->description,
        ':rental_type' => $listing->rental_type,
        ':price' => $listing->price,
        ':num_beds' => $listing->num_beds,
        ':num_baths' => $listing->num_baths,
        ':is_furnished' => $listing->is_furnished,
        ':allows_pets' => $listing->allows_pets,
        ':has_parking' => $listing->has_parking,
        ':timestamp' => $listing->timestamp,
        ':view_count' => $listing->view_count,
        ':sponsored_tier' => $listing->sponsored_tier,
    ]);

    if ($result) {
        return true;
    } else {
        return false;
    }
} 

/**
 * add_listing_photos
 * Adds photos to a listing in the database
 * @param  int $listingId
 * @param  array $photos
 * @return bool
 */
function add_listing_photos($listingId, $photos) {
    
    if (!isset($photos) || !is_array($photos['name']))
        return false;

     // Iterate over each file
     for ($i = 0; $i < count($photos['name']); $i++) 
     {
        // Skip upload if there's an error with a file
        if ($photos['error'][$i] != 0) {
            return false;
        }

        $target_dir = "./uploads/listings/";
        $imageFileType = strtolower(pathinfo($photos['name'][$i], PATHINFO_EXTENSION));
        $newFileName = $listingId . "_" . rand(100000, 999999) . "." . $imageFileType;
        $target_file = $target_dir . $newFileName;

        if (move_uploaded_file($photos['tmp_name'][$i], $target_file)) 
        {
            $result = sqlQuery("INSERT INTO `listingphotos` VALUES(:listingId, :newFileName)", [
                ':listingId' => $listingId,
                ':newFileName' => $newFileName
            ]);
            
            if(!$result) return false;
        } 
        
        else return false;
    }

    return true;
}

/**
 * fetch_listing_photos
 * Fetches photos of a listing from the database
 * @param  int $listingId
 * @return array
 */
function fetch_listing_photos($listingId) {
    //...
}

/**
 * fetch_listing_id
 * Fetches the id of a listing, needs a URL slug
 * Returns 0 if not found
 * @param  string $listingSlug
 * @return int
 */
function fetch_listing_id($listingSlug) {
    //...
}

/**
 * update_listing
 * Updates a listing in the database
 * @param  int $listingId
 * @param  Listing $newdata
 * @return bool
 */
function update_listing($listingId, $newdata) {
    //...
}

/**
 * delete_listing
 * Deletes a listing from the database
 * @param  int $listingId
 * @return bool
 */
function delete_listing($listingId) 
{
    // Clean up the listing from the database
    // Clean up the listing images from the server
    // Clean up the listing messages from the database
    // Clean up EVERYTHING!
}
