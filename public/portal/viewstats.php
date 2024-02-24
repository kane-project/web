<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");
    require_once("lib/Messaging.php");
    require_once("lib/Statistics.php");

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

    $page = "View Listing Statistics";
    $user = new User($_SESSION['landlord_id']);
    include("header.php");

?>
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

        
    </main>

    <?php include("footer.php"); ?>

</body>
</html>