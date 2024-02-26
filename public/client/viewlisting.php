<?php
	
	require_once("lib/Listings.php");
	require_once("lib/Users.php");
	require_once("lib/Messaging.php");
	require_once("lib/Statistics.php");
	require_once("vendor/autoload.php");

	use GeoIp2\Database\Reader;

	session_start();

	$listingID = fetch_listing_id($slug);
	if(!$listingID) header("Location: /404.php");

	$listing = new Listing($listingID);

	// Update listing Stats here
	// If the sponsorship tier is greater than Bronze (Tier 1)

	if($listing->sponsored_tier > 1) 
	{
		$databaseFile = 'lib/third_party/GeoLite2-City.mmdb';
		$reader = new Reader($databaseFile);

		$statinfo = new StatPiece();
		$statinfo->listing_id = $listingID;
		$statinfo->is_user = isset($_SESSION['uid']) ? 1 : 0;
		$statinfo->timestamp = time();
		
		try 
		{
			$geoIpInfo = $reader->city($_SERVER['REMOTE_ADDR']);
			$statinfo->geoloc = $geoIpInfo->city->name.','.$geoIpInfo->country->name;
		} catch (Exception $e) {
			$statinfo->geoloc = "Unknown Location, Unknown Country";
		}

		add_listing_view($statinfo);
	}

	if(isset($_POST['initial_inquiry']))
	{
		$message = new Message();
		$message->message_id = generate_uuid();
		$message->sender_id = $_SESSION['uid'];
		$message->receiver_id = $listing->userid;
		$message->listing_id = $listingID;
		$message->content = $_POST['message'];
		$message->timestamp = time();
		$message->is_read = 0;

		if(send_message($message)) {
			header("Location: /account/messages?s=1");
		}

		else {
			throw new Exception("Error Processing Request", 1);
		}
	}

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
									<div class="row section-t3">
										<div class="col-sm-12">
											<div class="title-box-d">
												<h3 class="title-d">Contact Owner</h3>
												<p>Interested in this property? Contact the owner and place an inquiry.</p>
											</div>
										</div>
									</div>
									
									<?php 
										if(!isset($_SESSION['uid'])) {
											echo '
									<div class="row">
										<div class="col-sm-12">
											<div class="alert bg-primary text-light rounded-0">
												<i class="fa fa-info-circle"></i> Please login to send an inquiry.
											</div>
										</div>
									</div>
											';
										}

										if(isset($_SESSION['uid'])) {

											// Check if message already exists
											// if it does, show link to inbox
											// if it doesn't, show form to send message

											if(!check_initial_inquiry($_SESSION['uid'], $listingID)) {
												echo '
									<div class="row">
										<div class="col-sm-12">
											<form method="POST" action="/listing/'.$slug.'">
												<div class="mb-2">
													<textarea class="form-control rounded-0" style="resize:none;height:100px;" name="message" required>Hello! Is this listing still available?</textarea>
												</div>
												<div class="mb-3">
													<button type="submit" name="initial_inquiry" class="btn rounded-0 btn-dark">Send Message</button>
												</div>
											</form>
										</div>
									</div>
											';
											} else {
												echo '
											<div class="row">	
												<div class="col-sm-12">
													<div class="alert bg-primary text-light rounded-0">
														<i class="fa fa-info-circle"></i> You have already inquired about this listing.<br><br><a class="btn btn-sm btn-light rounded-0" href="/account/message/'.$listing->slug.'">Open Chat</a>
													</div>
												</div>
											</div>
												';

											}
										}
									?>
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
											<h3 class="title-d">View Map</h3>
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