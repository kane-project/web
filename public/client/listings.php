<?php

	require_once("lib/Listings.php");
	require_once("lib/Users.php");
	session_start();
	if (!isset($_GET['p'])) header("Location: /listings/?p=1");

	if(isset($_POST['apply_filters'])) 
	{
		if (isset($_POST['location'])) {
			// Remove province and country from location
			// Places API returns location in the format "City, Province, Country"
			$_POST['location'] = explode(',', $_POST['location'], 2)[0];
		}

		$urlParams = http_build_query($_POST);
		header("Location: /listings/?p=1&" . $urlParams);
		exit();
	}

	if(isset($_POST['reset_filters']))
	{
		$filters = array();
		die(header('Location: /listings/?p=1'));
	}

	$urlFilters = $_SERVER['QUERY_STRING'];
	$urlFilters = preg_replace('/&?p=\d+(&|$)/', '', $urlFilters);

	$limit = 24;
	$p = isset($_GET['p']) ? intval($_GET['p']) : 1;
	$offset = ($p - 1) * $limit;

	$filters = [];

	if(isset($_GET["location"])) $filters["location"] = $_GET["location"];
	if(isset($_GET["rental_type"])) $filters["rental_type"] = $_GET["rental_type"] == "Any" ? null : $_GET["rental_type"];
	if(isset($_GET["min_beds"])) $filters["min_bedrooms"] = $_GET["min_beds"] != "Any" ? $_GET["min_beds"] : null;
	if(isset($_GET["min_baths"])) $filters["min_bathrooms"] = $_GET["min_baths"] != "Any" ? $_GET["min_baths"] : null;
	if(isset($_GET["min_price"])) $filters["min_price"] = $_GET["min_price"] > 0 ? $_GET["min_price"] : null;
	if(isset($_GET["max_price"])) $filters["max_price"] = $_GET["max_price"] > 0 ? $_GET["max_price"] : null;
	if(isset($_GET["furnished"])) $filters["is_furnished"] = $_GET["furnished"] != "Any" ? 1 : null;
	if(isset($_GET["parking"])) $filters["has_parking"] = $_GET["parking"] != "Any" ? 1 : null;
	if(isset($_GET["pets"])) $filters["allows_pets"] = $_GET['pets'] != "Any" ? 1 : null;

	try {
		$listings = fetch_listings($filters, $offset, $limit);	
	} catch(Exception $e) {
		die(header("Location: /404"));
	}

	$totalListings = fetch_listings_count($filters);
	$totalPages = ceil($totalListings / $limit);

	$page = "Listings";
	include("header.php");
?>

<body>

	<?php include("navbar.php"); ?>

	<main id="main">

		<section class="intro-single">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-8">
						<div class="title-single-box">
							<h1 class="title-single">View All Listings</h1>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="property-grid grid">
			<div class="container">
				<div class="row">

					<aside class="aside col-lg-3 mb-3">
						<form method="POST" action="/listings/?p=1">
							<div class="mb-3">
								<label for="location" class="form-label">City</label>
								<input type="text" <?php if(isset($_GET['location']) && !empty($_GET['location'])) echo 'value='.$_GET['location']; ?> id="location" placeholder="All Cities" name="location" class="form-control rounded-0">								
							</div>
							<div class="mb-3">
								<label for="rental_type" class="form-label">Rental Type</label>
								<select name="rental_type" id="rental_type" class="form-select rounded-0">
									<option <?php echo isset($_GET['rental_type']) && $_GET['rental_type'] == 'Any' ? 'selected' : ''; ?> value="Any">Any</option>
									<option <?php echo isset($_GET['rental_type']) && $_GET['rental_type'] == 'Apartment' ? 'selected' : ''; ?> value="Apartment">Apartment</option>
									<option <?php echo isset($_GET['rental_type']) && $_GET['rental_type'] == 'Room' ? 'selected' : ''; ?> value="Room">Room</option>
									<option <?php echo isset($_GET['rental_type']) && $_GET['rental_type'] == 'House' ? 'selected' : ''; ?> value="House">House</option>
									<option <?php echo isset($_GET['rental_type']) && $_GET['rental_type'] == 'Condo' ? 'selected' : ''; ?> value="Condo">Condo</option>
									<option <?php echo isset($_GET['rental_type']) && $_GET['rental_type'] == 'Townhouse' ? 'selected' : ''; ?> value="Townhouse">Townhouse</option>
									<option <?php echo isset($_GET['rental_type']) && $_GET['rental_type'] == 'Loft' ? 'selected' : ''; ?> value="Loft">Loft</option>
									<option <?php echo isset($_GET['rental_type']) && $_GET['rental_type'] == 'Basement' ? 'selected' : ''; ?> value="Basement">Basement</option>
								</select>
							</div>
							<div class="mb-3">
								<label for="beds" class="form-label">Min Beds</label>
								<select name="min_beds" id="beds" class="form-select rounded-0">
									<option value="Any" <?php echo isset($_GET['min_beds']) && $_GET['min_beds'] == 'Any' ? 'selected' : ''; ?>>Any</option>
									<option value="0" <?php echo isset($_GET['min_beds']) && $_GET['min_beds'] == '0' ? 'selected' : ''; ?>>Studio</option>
									<option value="1" <?php echo isset($_GET['min_beds']) && $_GET['min_beds'] == '1' ? 'selected' : ''; ?>>1</option>
									<option value="2" <?php echo isset($_GET['min_beds']) && $_GET['min_beds'] == '2' ? 'selected' : ''; ?>>2</option>
									<option value="3" <?php echo isset($_GET['min_beds']) && $_GET['min_beds'] == '3' ? 'selected' : ''; ?>>3</option>
									<option value="4" <?php echo isset($_GET['min_beds']) && $_GET['min_beds'] == '4' ? 'selected' : ''; ?>>4+</option>
								</select>
							</div>
							<div class="mb-3">
								<label for="baths" class="form-label">Min Baths</label>
								<select name="min_baths" id="baths" class="form-select rounded-0">
									<option value="Any" <?php echo isset($_GET['min_baths']) && $_GET['min_baths'] == 'Any' ? 'selected' : ''; ?>>Any</option>
									<option value="1" <?php echo isset($_GET['min_baths']) && $_GET['min_baths'] == '1' ? 'selected' : ''; ?>>1</option>
									<option value="2" <?php echo isset($_GET['min_baths']) && $_GET['min_baths'] == '2' ? 'selected' : ''; ?>>2</option>
									<option value="3" <?php echo isset($_GET['min_baths']) && $_GET['min_baths'] == '3' ? 'selected' : ''; ?>>3</option>
									<option value="4" <?php echo isset($_GET['min_baths']) && $_GET['min_baths'] == '4' ? 'selected' : ''; ?>>4+</option>
								</select>
							</div>
							<div class="mb-3">
								<label for="min_price" class="form-label">Min Price</label>
								<input type="number" placeholder="Lowest" <?php if(isset($_GET['min_price'])) echo 'value='.$_GET['min_price']; ?> placeholder="Any" name="min_price" class="form-control rounded-0">
							</div>
							<div class="mb-3">
								<label for="max_price" class="form-label">Max Price</label>
								<input type="number" placeholder="Highest" <?php if(isset($_GET['max_price'])) echo 'value='.$_GET['max_price']; ?>  placeholder="Any" name="max_price" class="form-control rounded-0">
							</div>
							<div class="mb-3">
								<label for="furnished" class="form-label">Furnished</label>
								<select name="furnished" id="furnished" class="form-select rounded-0">
									<option <?php echo isset($_GET['furnished']) && $_GET['furnished'] != 'Any' ? 'selected' : ''; ?> value="Any">Any</option>
									<option <?php echo isset($_GET['furnished']) && $_GET['furnished'] != 'Any' ? 'selected' : ''; ?> value="1">Yes</option>
								</select>
							</div>
							<div class="mb-3">
								<label for="parking" class="form-label">Parking</label>
								<select name="parking" id="parking" class="form-select rounded-0">
									<option <?php echo isset($_GET['parking']) && $_GET['parking'] == 'Any' ? 'selected' : ''; ?> value="Any">Any</option>
									<option <?php echo isset($_GET['parking']) && $_GET['parking'] != 'Any' ? 'selected' : ''; ?> value="1">Available</option>
								</select>
							</div>
							<div class="mb-3">
								<label for="pets" class="form-label">Pets</label>
								<select name="pets" id="pets" class="form-select rounded-0">
									<option <?php echo isset($_GET['pets']) && $_GET['pets'] == 'Any' ? 'selected' : ''; ?> value="Any">Any</option>
									<option <?php echo isset($_GET['pets']) && $_GET['pets'] != 'Any' ? 'selected' : ''; ?> value="1">Allowed</option>
								</select>
							</div>
							<div class="mb-1">
								<button type="submit" name="apply_filters" class="btn rounded-0 btn-dark">Apply Filters</button>
							</div>
						</form>

						<form class="py-2" action="/listings/?p=1" method="POST">
							<div class="mb-1">
								<button type="submit" name="reset_filters" class="btn rounded-0 btn-light">Reset Filters</button>
							</div>
						</form>

					</aside>

					<div class="col-lg-9">

						<?php if(sizeof($listings)) { ?>
						<div class="row">
							
							<?php
								foreach($listings as $listing) {
									$listingPrice = 'CA$'.number_format($listing->price, 2).'/mo';
									$listingPhoto = fetch_listing_photos($listing->id)[0]['photo'];
									$num_beds = $listing->num_beds == 0? "Studio": $listing->num_beds;
									$sponsoredBadge = $listing->sponsored_tier == 0 ? 
									"" : "<div class='badge bg-gold'>Sponsored</div>";

									echo <<<_END
									<div class="col-lg-4">
										<div class="card-box-a card-shadow">
											<div class="img-listing">
												<img src="/uploads/listings/$listingPhoto" alt="" class="img-fluid">
											</div>
											<div class="card-overlay">
												<div class="card-overlay-a-content">
													<div class="card-header-a">
														<h4>
															<a target="_blank" class="text-light" href="/listing/$listing->slug">$listing->title</a>
														</h4>
														<p class="text-light">$listing->address</p>
														<div class="p-2">
															$sponsoredBadge
														</div>
													</div>
													<div class="card-body-a">
														<div class="price-box d-flex">
															<span class="price-a">$listingPrice</span>
														</div>
														<a target="_blank" href="/listing/$listing->slug" class="link-a">View Listing
															<span class="bi bi-chevron-right"></span>
														</a>
													</div>
													<div class="card-footer-a">
														<ul class="card-info d-flex justify-content-around">
															<li>
																<h4 class="card-info-title text-light">Beds</h4>
																<span>$num_beds</span>
															</li>
															<li>
																<h4 class="card-info-title text-light">Baths</h4>
																<span>$listing->num_baths</span>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
_END;
								}

							?>

							<div class="col-sm-12">
								<nav class="pagination-a">
									<?php if($p > 1) echo '<a href="/listings/?p='.($p - 1).'&'.$urlFilters.'" class="btn btn-dark rounded-0"><i class="fa fa-arrow-left"></i>&nbsp; Prev Page</a>'; ?>
									<?php if($p < $totalPages) echo '<a href="/listings/?p='.($p + 1).'&'.$urlFilters.'" class="btn btn-dark rounded-0">Next Page &nbsp;<i class="fa fa-arrow-right"></i></a>'; ?>
								</nav>
							</div>

						</div>
						<?php } else 
							echo '
							<div class="row">
								<div class="col-lg-12">
									<div class="alert alert-info rounded-0" role="alert">
										<i class="fa fa-info-circle"></i> No listings found with the specified filters.
									</div>
								</div>
							</div>
							';
						?>

					</div>
				</div>

			</div>
		</section>

	</main>

	<?php include("footer.php"); ?>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_ENV['GOOGLE_MAPS_API_KEY']; ?>&libraries=places"></script>
	<script>
		var input = document.getElementById('location');
		var options = {
			types: ['(cities)'],
			componentRestrictions: { country: 'CA' }
		};
		var autocomplete = new google.maps.places.Autocomplete(input, options);
	</script>

</body>
</html>