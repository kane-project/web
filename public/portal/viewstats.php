<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");
    require_once("lib/Messaging.php");
    require_once("lib/Statistics.php");

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

    if(!isset($listingid)) die(header("Location: /portal/listings"));
    $listing = new Listing(fetch_listing_id($listingid));

    $page = "View Listing Statistics";
    $user = new User($_SESSION['landlord_id']);
    include("header.php");

    // Make meaningful use of the data we have here

    $stats = fetch_listing_views($listingid);
    $viewCount = fetch_view_count($listingid);
    loadEnv();
    
    $coordinates = array();    

    foreach ($stats as $statsinfo) 
    {
        list($city, $country) = explode(", ", $statsinfo->geoloc);
        $geocode = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($city . ", " . $country) . "&key=" . $_ENV['GOOGLE_MAPS_API_KEY']);
        $geocode = json_decode($geocode);
        if ($geocode->status == "OK") {
            $lat = $geocode->results[0]->geometry->location->lat;
            $lng = $geocode->results[0]->geometry->location->lng;
            $coordinates[] = array('lat' => $lat, 'lng' => $lng);
        }
    }

?>
<head></head>
<body>

    <?php include("navbar.php"); ?>

    <main class="mb-5">
        
        <section class="container">
            <div class="row py-1">
                <div class="col-lg-12 py-2 mx-auto text-center">
                    <h1>View Listing Statistics</h1>
                    <a class="text-primary" href="/portal/listings">&larr; Go back to Listings List</a>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="row py-3">

                <div class="col-lg-6">
                    <div class="card-rounded-0 shadow p-3">
                        <div class="card-body">
                            <!-- Show Line Chart here -->
                        </div>
                    </div>
                    <div class="card rounded-0 shadow bg-primary text-light p-3">
                        <div class="card-body">
                            <h1 class="text-light"><?php echo $viewCount; ?></h1>
                            <h3 class="card-title text-light">Total Listing Views</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card rounded-0 shadow p-2">
                        <div class="card-body">
                            <div id="map" style="height: 400px;"></div>
                        </div>
                        <div class="card-footer border-0 bg-light">
                            <p class="text-center">Top View Locations</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <?php include("footer.php"); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_ENV['GOOGLE_MAPS_API_KEY']; ?>"></script>
    <script>
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 0, lng: 0}, // Initial center of the map
            zoom: 1 // Initial zoom level
        });

        // Iterate through the coordinates array and create markers
        <?php foreach ($coordinates as $coord): ?>
            var marker = new google.maps.Marker({
                position: {lat: <?php echo $coord['lat']; ?>, lng: <?php echo $coord['lng']; ?>},
                map: map
            });
        <?php endforeach; ?>
        console.log("Map initialized");
    }

    // Call the initMap function when the page loads
    google.maps.event.addDomListener(window, 'load', initMap);
    </script>

</body>
</html>