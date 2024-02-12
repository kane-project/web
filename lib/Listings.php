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
 * Fetches listings based on provided filters
 * @param  array $filters
 * @param int $start
 * @param int $limit
 * @return array
 */
function fetch_listings($filters, $start, $limit) 
{
    $sql_query_string = "SELECT * FROM listings WHERE 1=1";
    $params = [];

    if (isset($filters['rental_type']) && $filters['rental_type'] != null) {
        $sql_query_string .= " AND rental_type = ?";
        $params[] = $filters['rental_type'];
    }

    if (isset($filters['min_price']) && $filters['min_price'] != null) {
        $sql_query_string .= " AND price >= ?";
        $params[] = $filters['min_price'];
    }

    if (isset($filters['max_price']) && $filters['max_price'] != null) {
        $sql_query_string .= " AND price <= ?";
        $params[] = $filters['max_price'];
    }

    if (isset($filters['min_bedrooms']) && $filters['min_bedrooms'] != null) {
        $sql_query_string .= " AND num_beds >= ?";
        $params[] = $filters['min_bedrooms'];
    }

    if (isset($filters['max_bedrooms']) && $filters['max_bedrooms'] != null) {
        $sql_query_string .= " AND num_beds <= ?";
        $params[] = $filters['max_bedrooms'];
    }

    if (isset($filters['min_bathrooms']) && $filters['min_bathrooms'] != null) {
        $sql_query_string .= " AND num_baths >= ?";
        $params[] = $filters['min_bathrooms'];
    }

    if (isset($filters['max_bathrooms']) && $filters['max_bathrooms'] != null) {
        $sql_query_string .= " AND num_baths <= ?";
        $params[] = $filters['max_bathrooms'];
    }

    if (isset($filters['user_id']) && $filters['user_id'] != null) {
        $sql_query_string .= " AND userid = ?";
        $params[] = $filters['user_id'];
    }

    if (isset($filters['is_furnished']) && $filters['is_furnished'] != null) {
        $sql_query_string .= " AND is_furnished = ?";
        $params[] = $filters['is_furnished'];
    }

    if (isset($filters['has_parking']) && $filters['has_parking'] != null) {
        $sql_query_string .= " AND has_parking = ?";
        $params[] = $filters['has_parking'];
    }

    if (isset($filters['allows_pets']) && $filters['allows_pets'] != null) {
        $sql_query_string .= " AND allows_pets = ?";
        $params[] = $filters['allows_pets'];
    }

    if(isset($filters['location']) && !empty($filters['location'])) {
        $sql_query_string .= ' AND address LIKE ?';
        $params[] = '%' . $filters['location'] . '%';
    }    

    // Add sorting criteria
    $sql_query_string .= " ORDER BY sponsored_tier DESC, timestamp DESC LIMIT $start, $limit";

    try 
    {
        $result = sqlQuery($sql_query_string, $params);
        $listings = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $listing = new Listing($row['id']);
            $listings[] = $listing;
        }

        return $listings;
    } catch (PDOException $e) {
        error_log("Error fetching listings: " . $e->getMessage());
        return [];
    }
}

/**
 * fetch_listings_count
 * Fetches the count of listings from the database based on provided filters
 * @param  array $filters An array of filters to apply to the query
 * @return int The count of listings
 */
function fetch_listings_count($filters) 
{
    // Initialize the SQL query string
    $sql_query_string = "SELECT COUNT(*) AS count FROM listings WHERE 1=1";

    // Initialize an array to store the parameters
    $params = [];

    // Check and append filters to the SQL query string
    if (isset($filters['rental_type']) && $filters['rental_type'] != null) {
        $sql_query_string .= " AND rental_type = ?";
        $params[] = $filters['rental_type'];
    }

    if (isset($filters['min_price']) && $filters['min_price'] != null) {
        $sql_query_string .= " AND price >= ?";
        $params[] = $filters['min_price'];
    }

    if (isset($filters['max_price']) && $filters['max_price'] != null) {
        $sql_query_string .= " AND price <= ?";
        $params[] = $filters['max_price'];
    }

    if (isset($filters['min_bedrooms']) && $filters['min_bedrooms'] != null) {
        $sql_query_string .= " AND num_beds >= ?";
        $params[] = $filters['min_bedrooms'];
    }

    if (isset($filters['max_bedrooms']) && $filters['max_bedrooms'] != null) {
        $sql_query_string .= " AND num_beds <= ?";
        $params[] = $filters['max_bedrooms'];
    }

    if (isset($filters['min_bathrooms']) && $filters['min_bathrooms'] != null) {
        $sql_query_string .= " AND num_baths >= ?";
        $params[] = $filters['min_bathrooms'];
    }

    if (isset($filters['max_bathrooms']) && $filters['max_bathrooms'] != null) {
        $sql_query_string .= " AND num_baths <= ?";
        $params[] = $filters['max_bathrooms'];
    }

    if (isset($filters['user_id']) && $filters['user_id'] != null) {
        $sql_query_string .= " AND userid = ?";
        $params[] = $filters['user_id'];
    }

    if (isset($filters['is_furnished']) && $filters['is_furnished'] != null) {
        $sql_query_string .= " AND is_furnished = ?";
        $params[] = $filters['is_furnished'];
    }

    if (isset($filters['has_parking']) && $filters['has_parking'] != null) {
        $sql_query_string .= " AND has_parking = ?";
        $params[] = $filters['has_parking'];
    }

    if (isset($filters['allows_pets']) && $filters['allows_pets'] != null) {
        $sql_query_string .= " AND allows_pets = ?";
        $params[] = $filters['allows_pets'];
    }

    if(isset($filters['location']) && !empty($filters['location'])) {
        $sql_query_string .= ' AND address LIKE ?';
        $params[] = '%' . $filters['location'] . '%';
    }    

    try {
        // Execute the query with the parameters
        $result = sqlQuery($sql_query_string, $params);
        
        // Fetch the count from the result
        $count = $result->fetch()['count'];

        // Return the count
        return $count;
    } catch (PDOException $e) {
        // Handle database errors
        // You may log the error, display a user-friendly message, or rethrow the exception
        error_log("Error fetching listings count: " . $e->getMessage());
        return false; // Return false or handle the error as appropriate for your application
    }
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
    try {
        $result = sqlQuery("SELECT * FROM `listingphotos` WHERE listingid = ?", [$listingId]);
        $photos = $result->fetchAll(PDO::FETCH_ASSOC);
        return $photos;
    } catch (Exception $e) {
        error_log($e->getMessage());
        return [];
    }
}

/**
 * fetch_listing_id
 * Fetches the id of a listing, needs a URL slug
 * Returns 0 if not found
 * @param  string $listingSlug
 * @return int
 */
function fetch_listing_id($listingSlug) {
    $result = sqlQuery("SELECT id FROM `listings` WHERE slug = ?", [$listingSlug])->fetch(PDO::FETCH_ASSOC);
    if ($result != null) {
        return $result['id'];
    } else {
        return 0;
    }
}

/**
 * update_listing
 * Updates a listing in the database
 * @param  int $listingId
 * @param  Listing $newdata
 * @return bool
 */
function update_listing($listingId, $newdata) {
    $result = sqlQuery("UPDATE `listings` SET 
        title = :title,
        address = :address,
        description = :description,
        rental_type = :rental_type,
        price = :price,
        num_beds = :num_beds,
        num_baths = :num_baths,
        is_furnished = :is_furnished,
        allows_pets = :allows_pets,
        has_parking = :has_parking
        WHERE id = :id", [
        ':id' => $listingId,
        ':title' => $newdata->title,
        ':address' => $newdata->address,
        ':description' => $newdata->description,
        ':rental_type' => $newdata->rental_type,
        ':price' => $newdata->price,
        ':num_beds' => $newdata->num_beds,
        ':num_baths' => $newdata->num_baths,
        ':is_furnished' => $newdata->is_furnished,
        ':allows_pets' => $newdata->allows_pets,
        ':has_parking' => $newdata->has_parking
    ]);

    if (!$result)
        return false;
    
    return true;
}

/**
 * delete_listing
 * Deletes a listing from the database
 * @param  int $listingId
 * @return bool
 */
function delete_listing($listingId) 
{
    // Move listing to trash database

    $listing = new Listing($listingId);
    $result = trashSqlQuery("INSERT INTO `listings` (id, userid, slug, title, address, description, rental_type, price, num_beds, num_baths, is_furnished, allows_pets, has_parking, timestamp, view_count, sponsored_tier) 
    VALUES (:id, :userid, :slug, :title, :address, :description, :rental_type, :price, :num_beds, :num_baths, :is_furnished, :allows_pets, :has_parking, :timestamp, :view_count, :sponsored_tier)", [
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
        ':sponsored_tier' => $listing->sponsored_tier
    ]);

    if (!$result)
        return false;

    // Delete listing from main database

    // Delete photos
    $photos = fetch_listing_photos($listingId);
    foreach ($photos as $photo) {
        $target_file = "./uploads/listings/" . $photo['photo'];
        if (!unlink($target_file)) return false;
    }
    
    // Delete photos from database
    $result = sqlQuery("DELETE FROM `listingphotos` WHERE listingid = ?", [$listingId]);
    if (!$result) return false;

    // Delete listing
    $result = sqlQuery("DELETE FROM `listings` WHERE id = ?", [$listingId]);
    if (!$result) return false;
    else return true;

    // NOTE: Messages and other interactions will simply show the listing
    // as "deleted"
    
}
