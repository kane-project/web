<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");
    require_once("lib/Messaging.php");

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

    $listing = new Listing($id);

    if(isset($_POST['edit_listing']))
    {
        $newListing = new Listing($id);
        $newListing->title = $_POST['title'];
        $newListing->address = $_POST['address'];
        $newListing->description = $_POST['description'];
        $newListing->rental_type = $_POST['type'];
        $newListing->price = $_POST['price'];
        $newListing->num_beds = $_POST['num_beds'];
        $newListing->num_baths = $_POST['num_baths'];
        $newListing->is_furnished = $_POST['is_furnished'];
        $newListing->allows_pets = $_POST['allows_pets'];
        $newListing->has_parking = $_POST['has_parking'];
        
        if(update_listing($listing->id, $newListing))
            header("Location: /portal/listing/$id?es");
        else
            header("Location: /portal/listing/$id?lfe");
    }

    $page = "Viewing Details for '$listing->title'";
    $user = new User($_SESSION['landlord_id']);
    include("header.php");

?>
<body>

    <?php include("navbar.php"); ?>

    <main>
        
        <section class="container py-5">
            <div class="row py-3">
                <div class="col-lg-6 mx-auto py-2">
                    <h1 class="text-center">Edit Listing Details</h1>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-lg-7 mx-auto">
                    <div class="card p-2 shadow rounded-0">
                        <div class="card-body">
                            <form id="edit_listing_form" method="POST" action="/portal/listing/<?php echo $listing->id; ?>" enctype="multipart/form-data">
                                <?php

                                    if(isset($_GET['es'])) {
                                        echo '<div class="mb-3">
                                                <div class="alert alert-success alert-dismissible fade show rounded-0" role="alert">
                                                    Listing details updated successfully!
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </div>';
                                    }

                                    if(isset($_GET['lfe'])) {
                                        echo '<div class="mb-3">
                                                <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                                                    Error updating listing. Please contact the site administrator.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </div>';
                                    }

                                ?>

                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control rounded-0" id="title" name="title" value="<?php echo $listing->title; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control rounded-0" id="address" name="address" value="<?php echo $listing->address; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="mb-2">Description</label>
                                    <textarea placeholder="Write a description for your listing here..." name="description" class="form-control rounded-0" id="description" style="resize:none;height:200px;"><?php echo $listing->description; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="type">Type</label>
                                    <select class="form-select rounded-0" id="type" name="type" required>
                                        <option value="Apartment" <?php if($listing->rental_type == "Apartment") echo "selected"; ?>>Apartment</option>
                                        <option value="House" <?php if($listing->rental_type == "House") echo "selected"; ?>>House</option>
                                        <option value="Condo" <?php if($listing->rental_type == "Condo") echo "selected"; ?>>Condo</option>
                                        <option value="Townhouse" <?php if($listing->rental_type == "Townhouse") echo "selected"; ?>>Townhouse</option>
                                        <option value="Loft <?php if($listing->rental_type == "Loft") echo "selected"; ?>">Loft</option>
                                        <option value="Basement" <?php if($listing->rental_type == "Basement") echo "selected"; ?>>Basement</option>
                                        <option value="Other" <?php if($listing->rental_type == "Other") echo "selected"; ?>>Other</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control rounded-0" id="price" name="price" value="<?php echo $listing->price; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bedrooms" class="form-label">Bedrooms</label>
                                    <input type="number" class="form-control rounded-0" id="bedrooms" name="num_beds" value="<?php echo $listing->num_beds; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bathrooms" class="form-label">Bathrooms</label>
                                    <input type="number" class="form-control rounded-0" id="bathrooms" name="num_baths" value="<?php echo $listing->num_baths; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="furnished">Furnished</label>
                                    <select class="form-control rounded-0" id="furnished" name="is_furnished" required>
                                        <option value="0" <?php if($listing->is_furnished == 0) echo "selected"; ?>>No</option>
                                        <option value="1" <?php if($listing->is_furnished == 1) echo "selected"; ?>>Yes</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pets">Pets Allowed</label>
                                    <select class="form-control rounded-0" id="pets" name="allows_pets" required>
                                        <option value="0" <?php if($listing->allows_pets == 0) echo "selected"; ?>>No</option>
                                        <option value="1" <?php if($listing->allows_pets == 1) echo "selected"; ?>>Yes</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="parking">Parking</label>
                                    <select class="form-control rounded-0" id="parking" name="has_parking" required>
                                        <option value="0" <?php if($listing->has_parking == 0) echo "selected"; ?>>No</option>
                                        <option value="1" <?php if($listing->has_parking == 1) echo "selected"; ?>>Yes</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="edit_listing" class="btn btn-primary col-12 rounded-0">Publish Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include("footer.php"); ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_ENV['GOOGLE_MAPS_API_KEY']; ?>&libraries=places"></script>

    <script>
        // Google Maps API
        function initialize() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: {
                    country: 'CA'
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            initialize();
            quill.on('editor-change', function () {
                document.getElementById('description').value = quill.root.innerHTML;
            });
        });
    </script>

</body>
</html>