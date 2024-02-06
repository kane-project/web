<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");
    require_once("lib/Payments.php");

    session_start();
    if (!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

    if (isset($_POST['add_listing'])) 
    {
        // Initialize the Listing object to add it into DB:

        $listing = new Listing();
        $listing->id = generate_uuid();
        $listing->userid = $_SESSION['landlord_id'];
        $listing->slug = slugify($_POST['title']);
        $listing->title = $_POST['title'];
        $listing->address = $_POST['address'];
        $listing->rental_type = $_POST['rental_type'];
        $listing->price = $_POST['price'];
        $listing->num_beds = $_POST['num_beds'];
        $listing->num_baths = $_POST['num_baths'];
        $listing->description = $_POST['description'];
        $listing->is_furnished = $_POST['is_furnished'];
        $listing->allows_pets = $_POST['allows_pets'];
        $listing->has_parking = $_POST['has_parking'];
        $listing->sponsored_tier = $_POST['sponsored_tier'];
        $listing->timestamp = time();
        $listing->view_count = 0;

        // First, check if a sponsored tier was selected
        if ($_POST['sponsored_tier'] !== '0') 
        {
            $stripe_token = isset($_POST['payment_method']) ? $_POST['payment_method'] : null;
            $amount = 0;

            switch ($_POST['sponsored_tier']) 
            {
                case '1':
                    $amount = 299;
                    break;
                case '2':
                    $amount = 499;
                    break;
                case '3':
                    $amount = 999;
                    break;
            }

            if (!process_payment($stripe_token, $amount))
                die(header("Location: /portal/new?pye=1"));
        }

        // Then, try to upload photos
        if(!add_listing_photos($listing->id, $_FILES['images']))
            die(header("Location: /portal/new?phe=1"));

        if (!add_listing($listing))
            die(header("Location: /portal/new?lfe=1"));
        else
            die(header("Location: /portal/listings?success=1"));

    }

    $page = "New Listing";
    $user = new User($_SESSION['landlord_id']);
    include("header.php");
    loadEnv();
?>
<head><link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"></head>
<body>

    <?php include("navbar.php"); ?>

    <main>
        <section class="container py-5">
            <div class="row py-3">
                <div class="col-lg-12 py-2 mx-auto text-center">
                    <h1>Add New Listing</h1>
                </div>
            </div>

            <div class="row py-2">
                <div class="col-lg-7 mx-auto">
                    <div class="card p-2 shadow rounded-0">
                        <div class="card-body">
                            <form id="add_listing_form" method="POST" action="/portal/new" enctype="multipart/form-data">

                                <?php
                                    if(isset($_GET['phe'])) {
                                        echo '<div class="mb-3">
                                                <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert">
                                                    Error uploading listing photos. Please upload image files only.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </div>';
                                    }

                                    if(isset($_GET['pye'])) {
                                        echo '<div class="mb-3">
                                                <div class="alert alert-warning alert-dismissible fade show rounded-0" role="alert">
                                                    Error processing payment. Please try again or choose a different card.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </div>';
                                    }

                                    if(isset($_GET['lfe'])) {
                                        echo '<div class="mb-3">
                                                <div class="alert alert-danger alert-dismissible fade show rounded-0" role="alert">
                                                    Error adding listing to the database. Please contact the site administrator.
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </div>';
                                    }

                                ?>

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
                                    <select class="form-control rounded-0" id="type" name="rental_type" required>
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
                                    <select class="form-control rounded-0" id="sponsored_tier" name="sponsored_tier" required onchange="handleSponsorshipChange()">
                                        <option value="0">None - $0.00</option>
                                        <option value="1">Bronze - $2.99 One-time Payment</option>
                                        <option value="2">Silver - $4.99 One-time Payment</option>
                                        <option value="3">Gold - $9.99 One-time Payment</option>
                                    </select>
                                    <p class="py-2">To read more about sponsorship benefits, visit <a target="_blank" class="text-primary" href="/pricing">this page</a>.</p>
                                </div>
                                <div id="payment-section" style="display: none;">
                                    <div class="mb-3">
                                        <label for="card-element" class="mb-1">Your Payment Details</label>
                                        <div id="card-element" class="form-control rounded-0"></div>
                                        <div id="card-errors" role="alert" class="text-danger"></div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn col-12 btn-dark rounded-0" id="submit-button" name="add_listing">Publish Listing</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_ENV['GOOGLE_MAPS_API_KEY']; ?>&libraries=places"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>    

        // Initilize Quill Editor

        var quill = new Quill('#description', {
            theme: 'snow'
        });
        
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

        document.addEventListener('DOMContentLoaded', initialize);

        // Payment Section

        function handleSponsorshipChange() {
            var selectedTier = document.getElementById('sponsored_tier').value;
            var paymentSection = document.getElementById('payment-section');

            if (selectedTier !== '0') {
                paymentSection.style.display = 'block';
            } else {
                paymentSection.style.display = 'none';
            }
        }

        var stripe = Stripe('<?php echo $_ENV['STRIPE_TEST_PKEY']; ?>');
        var elements = stripe.elements();

        var card = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                },
            }
        });

        card.mount('#card-element');

        card.addEventListener('change', function (event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('add_listing_form');

        form.addEventListener('submit', async function (event) {
            var selectedTier = document.getElementById('sponsored_tier').value;
            console.log("Selected Tier: " + selectedTier);

            if (selectedTier === '0') return;

            event.preventDefault();
           
            var { paymentMethod, error } = await stripe.createPaymentMethod({
                type: 'card',
                card: card,
            });

            if (error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } 
            
            else 
            {
                var paymentMethodInput = document.createElement('input');
                paymentMethodInput.type = 'hidden';
                paymentMethodInput.name = 'payment_method';
                paymentMethodInput.value = paymentMethod.id;
                form.appendChild(paymentMethodInput);
                var addListingInput = document.createElement('input');
                addListingInput.type = 'hidden';
                addListingInput.name = 'add_listing';
                addListingInput.value = '1';
                form.appendChild(addListingInput);
                form.submit();
            }

        });

    </script>

    <?php include("footer.php"); ?>

</body>
</html>