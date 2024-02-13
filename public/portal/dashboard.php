<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");
    require_once("lib/Messaging.php");

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

    $page = "Dashboard";
    $user = new User($_SESSION['landlord_id']);
    include("header.php");

?>
<body>

    <?php include("navbar.php"); ?>

    <main class="mb-5">
        
        <section class="container">
            <div class="row py-1">
                <div class="col-lg-12 py-2 mx-auto text-center">
                    <h1>Welcome, <?php echo $user->first_name; ?></h1>
                </div>
            </div>
            <div class="row py-2">
                <div class="col-lg-8 col-sm-12 mx-auto">
                    <div class="col-lg-12 py-2 mx-auto">
                        <div class="card bg-washed-pink text-light p-3 rounded-0 shadow">
                            <div class="card-body">
                                <h1 class="text-light"><i class="fa fa-layer-group"></i>&nbsp; 
                                <?php $filters = ["user_id" => $_SESSION['landlord_id']]; echo fetch_listings_count($filters); ?></h1>
                                <p class="lead">Published Listings</p>
                                <a href="/portal/new" class="btn btn-light btn-lg rounded-0"><i class="fa fa-plus"></i>&nbsp; Add New</a> &nbsp;
                                <a href="/portal/listings" class="btn btn-light btn-lg rounded-0">View All &nbsp;<i class="fa fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 py-2 mx-auto">
                        <div class="card bg-kanegray text-light p-3 rounded-0 shadow">
                            <div class="card-body">
                                <h1 class="text-light"><i class="fa fa-bell"></i>&nbsp; <code>notif_count</code></h1>
                                <p class="lead">New Messages</p>
                                <a href="/portal/messages/" class="btn btn-light btn-lg rounded-0"><i class="fa fa-envelope"></i>&nbsp; Open Inbox</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include("footer.php"); ?>

</body>
</html>