<?php
	
	require_once("lib/Listings.php");
	require_once("lib/Users.php");
	session_start();

	$listingID = fetch_listing_id($slug);
	if(!$listingID) header("Location: /404.php");

	$listing = new Listing($listingID);

	$page = "$listing->title"; 
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
							<h1 class="title-single"><?php echo $listing->title; ?></h1>
							<span class="color-text-a"><?php echo $listing->address; ?></span>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="property-single nav-arrow-b">
			<div class="container">

				<div class="row mb-3 justify-content-center">
					<div class="col-lg-8">
						<div id="property-single-carousel" class="swiper img-listing">
							<div class="swiper-wrapper">
								<?php
									$listingPhotos = fetch_listing_photos($listingID);
									foreach($listingPhotos as $photo) {
										echo '
										<div class="carousel-item-b swiper-slide">
											<img src="/uploads/listings/'.$photo['photo'].'" alt="Listing Image">
										</div>';
									}
								?>
							</div>
						</div>
						<div class="property-single-carousel-pagination carousel-pagination"></div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12">

						<div class="row justify-content-between">
							<div class="col-md-5 col-lg-4">
								<div class="property-price d-flex justify-content-center foo">
									<div class="card-header-c d-flex">
										<div class="card-box-ico">
											<div class="p-2">
												<h5 class="title-c">$<?php echo number_format($listing->price, 2); ?>/mo</h5>
											</div>
										</div>
									</div>
								</div>
								<div class="property-summary">
									<div class="row">
										<div class="col-sm-12">
											<div class="title-box-d section-t4">
												<h3 class="title-d">Property Info</h3>
											</div>
										</div>
									</div>
									<div class="summary-list">
										<ul class="list">
											<li class="d-flex justify-content-between">
												<strong>Rental Type:</strong>
												<span><?php echo $listing->rental_type; ?></span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Beds:</strong>
												<span><?php echo $listing->num_beds == 0 ? "Studio" : $listing->num_beds; ?></span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Baths:</strong>
												<span><?php echo $listing->num_baths; ?></span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Furnished?</strong>
												<span><?php echo $listing->is_furnished ? "Yes" : "No"; ?></span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Parking</strong>
												<span><?php echo $listing->has_parking ? "Yes" : "No"; ?></span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Allows Pets</strong>
												<span><?php echo $listing->allows_pets ? "Yes" : "No"; ?></span>
											</li>
										</ul>
										<div class="py-1">
											<a target="_blank" class="btn btn-dark rounded-0" href="/report/<?php echo $listing->slug ?>">Report Listing</a>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-7 mt-4 col-lg-7 section-md-t3">
								<div class="row">
									<div class="col-sm-12">
										<div class="title-box-d">
											<h3 class="title-d">Property Description</h3>
										</div>
									</div>
								</div>
								<div class="property-description">
									<?php echo $listing->description; ?>
								</div>
								
								<div class="row section-t3">
									<div class="col-sm-12">
										<div class="title-box-d">
											<h3 class="title-d">Contact Owner</h3>
											<p>Interested in this property? Contact the owner and place an inquiry.</p>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-sm-12">
										<div id="map-container">
											<iframe
												width="600"
												height="400"
												frameborder="0"
												style="border:0"
												src="https://www.google.com/maps/embed/v1/place?q=<?php echo urlencode($listing->address); ?>&key=<?php echo $_ENV['GOOGLE_MAPS_API_KEY']; ?>"
												allowfullscreen>
											</iframe>
										</div>
									</div>
								</div>
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