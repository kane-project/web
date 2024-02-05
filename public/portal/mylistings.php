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

    <main>
        
        <section class="container dashboard-counters py-5">
            <div class="row py-3">
                <div class="col-lg-12 py-2 mx-auto text-center">
                    <h1>My Listings</h1>
                </div>
            </div>
            <?php
                if(isset($_GET['success']))
                {
                    echo '<div class="row"><div class="col-lg-12 mx-auto"><div class="alert alert-success rounded-0 alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Your listing has been successfully published!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div></div></div>';
                }
            ?>
            <div class="row mt-5">
                <div class="col-lg-12 mx-auto">
                    <div class="card shadow rounded-0">
                        <div class="card-body">
                            <?php if(sizeof($listings)) { ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Date Added</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($listings as $listing) {

                                            $listing_date = date("d/m/y", $listing->timestamp);
                                            $listing_price = number_format($listing->price, 2, '.', ',');

                                            echo <<<_LISTINGENTRY
                                            <tr>
                                                <td style="padding: 10px;">$listing->title</td>
                                                <td style="padding: 10px;">$listing_date</td>
                                                <td style="padding: 10px;">$$listing_price</td>
                                                <td style="padding: 10px;">
                                                    <a href="/portal/listing/$listing->id" class="p-1 btn btn-primary rounded-0 btn-sm"><i class="fa fa-pen"></i></a>&nbsp;
                                                    <a href="#" class="p-1 btn btn-danger rounded-0 btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-listing-id="$listing->id"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
_LISTINGENTRY;
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <?php } else { ?>
                            <div class="alert col-6 p-4 mx-auto alert-primary rounded-0" role="alert">
                                <i class="fa fa-info-circle"></i>&nbsp; You have not added any listings yet. 
                                <div class="mt-3">
                                    <a class="btn btn-light rounded-0" href="/portal/new">Add Listing</a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
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
                        <a href="/portal/deletelisting?id=" class="btn btn-danger rounded-0" id="deleteListingLink">Delete</a>
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
                    deleteLink.href = '/portal/deletelisting?id=' + listingId;
                    myModal.show();
                    event.preventDefault();
                }
            });
        </script>

    </main>

</body>
</html>