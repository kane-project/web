<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");
    require_once("lib/Messaging.php");

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

    $page = "My Listings";
    $user = new User($_SESSION['landlord_id']);
    include("header.php");

    $filters = array("user_id" => $_SESSION['landlord_id']);
    $listings = fetch_listings($filters, 0, fetch_listings_count($filters));
?>
<body>

    <?php include("navbar.php"); ?>

    <main class="mb-5">
        
        <section class="container">
            <div class="row py-1">
                <div class="col-lg-12 py-2 mx-auto text-center">
                    <h1>My Listings</h1>
                </div>
            </div>
            <?php
                if(isset($_GET['s']))
                {
                    echo '<div class="row"><div class="col-lg-6 col-sm-12 mx-auto"><div class="alert alert-success rounded-0 alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Your listing has been successfully published!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div></div></div>';
                }

                if(isset($_GET['ds']))
                {
                    echo '<div class="row"><div class="col-lg-6 col-sm-12 mx-auto"><div class="alert bg-primary text-light rounded-0 alert-dismissible fade show" role="alert">
                            <i class="fa fa-info-circle"></i> Your listing has been removed successfully.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div></div></div>';
                }

                if(isset($_GET['de']))
                {
                    echo '<div class="row"><div class="col-lg-6 col-sm-12 mx-auto"><div class="alert bg-danger text-light rounded-0 alert-dismissible fade show" role="alert">
                            <i class="fa fa-info-circle"></i> Failed to remove your listing. Please contact support.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div></div></div>';
                }
            ?>
            <div class="row mt-5">
                <div class="col-lg-12 mx-auto">
                    <?php if(sizeof($listings)) { 
                        
                        foreach($listings as $listing) {
                            $listing_date = date("d M, Y", $listing->timestamp);
                            $listing_price = number_format($listing->price, 2);
                            $sponsorship_tier = "None";
                            $stats_button = "<a href='javascript:void()' class='btn btn-disabled btn-secondary rounded-0'><i class='fa fa-lock'></i> No Stats</a>";
                            
                            switch($listing->sponsored_tier) {
                                case 1:
                                    $sponsorship_tier = "Bronze &nbsp;<i class='text-bronze fa fa-award'></i>";
                                    break;
                                case 2:
                                    $sponsorship_tier = "Silver &nbsp;<i class='text-silver fa fa-award'></i>";
                                    $stats_button = "<a href='/portal/view-stats/$listing->id' class='btn btn-success rounded-0'><i class='fas fa-chart-bar'></i> Stats</a>";
                                    break;
                                case 3:
                                    $sponsorship_tier = "Gold &nbsp;<i class='text-gold fa fa-award'></i>";
                                    $stats_button = "<a href='/portal/view-stats/$listing->id' class='btn btn-success rounded-0'><i class='fas fa-chart-bar'></i> Stats</a>";
                                    break;
                            }

                            echo <<<_LISTINGCARD
                            <div class="card shadow col-lg-6 mx-auto rounded-0 p-2 mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">$listing->title</h5>
                                    <p class="card-text">$listing->address</p>
                                    <p class="card-text"><i class="fas fa-dollar-sign"></i>&nbsp; $listing_price per mo.</p>
                                    <p class="card-text"><i class="fas fa-bed"></i>&nbsp; $listing->num_beds</p>
                                    <p class="card-text"><i class="fas fa-bath"></i>&nbsp; $listing->num_baths</p>
                                    <p class="card-text"><i class="fas fa-calendar-alt"></i>&nbsp; $listing_date</p>
                                    <p class="card-text"><i class="fas fa-bolt"></i>&nbsp; $sponsorship_tier</p>
                                    <a href="/portal/listing/$listing->id" class="btn btn-dark rounded-0"><i class="fas fa-pen"></i>&nbsp; Edit</a>&nbsp;
                                    $stats_button&nbsp;
                                    <a href="#" class="btn btn-danger rounded-0" data-bs-toggle="modal" data-listing-id="$listing->id"><i class="fas fa-trash"></i> Delete</a>
                                </div>
                            </div>
_LISTINGCARD;
                        }
                    ?>
                    
                    <?php } else { ?>
                    <div class="alert col-lg-8 col-sm-12 p-4 mx-auto alert-primary rounded-0" role="alert">
                        <i class="fa fa-info-circle"></i>&nbsp; You have not added any listings yet. 
                        <div class="mt-3">
                            <a class="btn btn-light rounded-0" href="/portal/new">Add Listing</a>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>
        </section>
        

        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this listing?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark rounded-0" data-bs-dismiss="modal">Cancel</button>
                        <a href="javascript:void();" class="btn btn-danger rounded-0" id="deleteListingLink">Confirm Deletion</a>
                    </div>
                </div>
            </div>
        </div>

        <?php include("footer.php"); ?>

        <script>
            var myModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            document.addEventListener('click', function (event) {
                var deleteButton = event.target.closest('.btn-danger[data-bs-toggle="modal"]');
                if (deleteButton) {
                    var listingId = deleteButton.getAttribute('data-listing-id');
                    var deleteLink = document.getElementById('deleteListingLink');
                    deleteLink.href = '/portal/delete-listing/' + listingId;
                    myModal.show();
                    event.preventDefault();
                }
            });
        </script>

    </main>

</body>
</html>