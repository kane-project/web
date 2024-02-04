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

?>
<body class="d-flex flex-column vh-100">

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
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="card shadow rounded-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Listing 1</td>
                                            <td>Description 1</td>
                                            <td>$100</td>
                                        </tr>
                                        <tr>
                                            <td>Listing 2</td>
                                            <td>Description 2</td>
                                            <td>$200</td>
                                        </tr>
                                        <tr>
                                            <td>Listing 3</td>
                                            <td>Description 3</td>
                                            <td>$300</td>
                                        </tr>
                                        <tr>
                                            <td>Listing 3</td>
                                            <td>Description 3</td>
                                            <td>$300</td>
                                        </tr>
                                        <tr>
                                            <td>Listing 3</td>
                                            <td>Description 3</td>
                                            <td>$300</td>
                                        </tr>
                                        <tr>
                                            <td>Listing 3</td>
                                            <td>Description 3</td>
                                            <td>$300</td>
                                        </tr>
                                        <tr>
                                            <td>Listing 3</td>
                                            <td>Description 3</td>
                                            <td>$300</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php $stickyfooter = true; include("footer.php"); ?>

</body>
</html>