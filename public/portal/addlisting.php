<?php

require_once("lib/Users.php");
require_once("lib/Listings.php");
require_once("lib/Messaging.php");

session_start();
if (!isset($_SESSION['landlord_id']))
    die(header("Location: /portal/login"));

if (isset($_POST['add_listing'])) {
    //...
}

$page = "New Listing";
$user = new User($_SESSION['landlord_id']);
include("header.php");
loadEnv();
?>

<body>

    <?php include("navbar.php"); ?>

    <main>

        <section class="container dashboard-counters py-5">
            <div class="row py-3">
                <div class="col-lg-12 py-2 mx-auto text-center">
                    <h1>Add New Listing</h1>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-lg-8 mx-auto">
                    <div class="card p-2 shadow rounded-0">
                        <div class="card-body">
                            <form method="post" action="/portal/addlisting" enctype="multipart/form-data">

                                <div class="mb-3">
                                    <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert">
                                        Generic Error Message
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                                        General Fatal Error Message
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" placeholder="Write a title for your listing..." class="form-control rounded-0" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address">Address</label>
                                    <input type="text" placeholder="Start typing the listing address..." class="form-control rounded-0" id="address" name="address" required>
                                </div>
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select class="form-control rounded-0" id="type" name="type" required>
                                        <option value="Apartment">Apartment</option>
                                        <option value="Room">Room</option>
                                        <option value="House">House</option>
                                        <option value="Condo">Condo</option>
                                        <option value="Townhouse">Townhouse</option>
                                        <option value="Studio">Studio</option>
                                        <option value="Loft">Loft</option>
                                        <option value="Basement">Basement</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price">Price</label>
                                    <input type="number" min="0" class="form-control rounded-0" id="price" name="price" required>
                                </div>
                                <div class="mb-3">
                                    <label for="beds">Number of Beds</label>
                                    <input type="number" min="0" class="form-control rounded-0" id="beds" name="num_beds" required>
                                </div>
                                <div class="mb-3">
                                    <label for="baths">Number of Baths</label>
                                    <input type="number" min="0" class="form-control rounded-0" id="baths" name="num_baths" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="mb-2">Description</label>
                                    <textarea placeholder="Write a detailed description..." class="form-control rounded-0" style="resize:none;height:200px;" id="description" name="description" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="furnished">Furnished</label>
                                    <select class="form-control rounded-0" id="furnished" name="is_furnished" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pets">Pets Allowed</label>
                                    <select class="form-control rounded-0" id="pets" name="allows_pets" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="parking">Parking</label>
                                    <select class="form-control rounded-0" id="parking" name="has_parking" required>
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="images">Listing Images</label>
                                    <input type="file" class="form-control rounded-0" id="images" name="images[]" multiple required>
                                </div>
                                <div class="mb-3">
                                    <label for="sponsored_tier" class="mb-2">Sponsored Tier</label>
                                    <select class="form-control rounded-0" id="sponsored_tier" name="sponsored_tier" required>
                                        <option value="0">None - $0.00</option>
                                        <option value="1">Bronze - $2.99 One-time Payment</option>
                                        <option value="2">Silver - $4.99 One-time Payment</option>
                                        <option value="3">Gold - $9.99 One-time Payment</option>
                                    </select>
                                    <p class="py-2">To read more about sponsorship benefits, visit <a href="/portal/sponsorship">this page</a>.</p>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn col-12 btn-dark rounded-0" name="add_listing">Publish Listing</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </main>

    <?php
    include("footer.php");
    ?>

    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_ENV['GOOGLE_MAPS_API_KEY']; ?>&libraries=places"></script>
    <script>
        function initialize() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: {
                    country: 'CA'
                }
            });
        }

        document.addEventListener('DOMContentLoaded', initialize);
    </script>

</body>
</html>