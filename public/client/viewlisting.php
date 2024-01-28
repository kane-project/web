<?php $page = "{ListingName}"; include("header.php"); ?>

<body>

	<?php include("navbar.php"); ?>

	<main id="main">

		<section class="intro-single">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-8">
						<div class="title-single-box">
							<h1 class="title-single">{Headline}</h1>
							<span class="color-text-a">{Address}</span>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="property-single nav-arrow-b">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<div id="property-single-carousel" class="swiper">
							<div class="swiper-wrapper">
								<div class="carousel-item-b swiper-slide">
									<img src="assets/img/slide-1.jpg" alt="">
								</div>
								<div class="carousel-item-b swiper-slide">
									<img src="assets/img/slide-2.jpg" alt="">
								</div>
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
											<span class="bi bi-cash">$</span>
										</div>
										<div class="card-title-c align-self-center">
											<h5 class="title-c">15000</h5>
										</div>
									</div>
								</div>
								<div class="property-summary">
									<div class="row">
										<div class="col-sm-12">
											<div class="title-box-d section-t4">
												<h3 class="title-d">Quick Summary</h3>
											</div>
										</div>
									</div>
									<div class="summary-list">
										<ul class="list">
											<li class="d-flex justify-content-between">
												<strong>Property ID:</strong>
												<span>1134</span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Location:</strong>
												<span>Chicago, IL 606543</span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Property Type:</strong>
												<span>House</span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Status:</strong>
												<span>Sale</span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Area:</strong>
												<span>340m
													<sup>2</sup>
												</span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Beds:</strong>
												<span>4</span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Baths:</strong>
												<span>2</span>
											</li>
											<li class="d-flex justify-content-between">
												<strong>Garage:</strong>
												<span>1</span>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-7 col-lg-7 section-md-t3">
								<div class="row">
									<div class="col-sm-12">
										<div class="title-box-d">
											<h3 class="title-d">Property Description</h3>
										</div>
									</div>
								</div>
								<div class="property-description">
									<p class="description color-text-a">
										Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit
										neque, auctor sit amet
										aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta.
										Curabitur aliquet quam id dui posuere blandit. Mauris blandit aliquet elit, eget tincidunt
										nibh pulvinar quam id dui posuere blandit.
									</p>
									<p class="description color-text-a no-margin">
										Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Donec rutrum congue leo eget
										malesuada. Quisque velit nisi,
										pretium ut lacinia in, elementum id enim. Donec sollicitudin molestie malesuada.
									</p>
								</div>
								<div class="row section-t3">
									<div class="col-sm-12">
										<div class="title-box-d">
											<h3 class="title-d">Amenities</h3>
										</div>
									</div>
								</div>
								<div class="amenities-list color-text-a">
									<ul class="list-a no-margin">
										<li>Balcony</li>
										<li>Outdoor Kitchen</li>
										<li>Cable Tv</li>
										<li>Deck</li>
										<li>Tennis Courts</li>
										<li>Internet</li>
										<li>Parking</li>
										<li>Sun Room</li>
										<li>Concrete Flooring</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-10 offset-md-1">
						<ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-video-tab" data-bs-toggle="pill" href="#pills-video" role="tab" aria-controls="pills-video" aria-selected="true">Video</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-plans-tab" data-bs-toggle="pill" href="#pills-plans" role="tab" aria-controls="pills-plans" aria-selected="false">Floor Plans</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="pills-map-tab" data-bs-toggle="pill" href="#pills-map" role="tab" aria-controls="pills-map" aria-selected="false">Ubication</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
								<iframe src="https://player.vimeo.com/video/73221098" width="100%" height="460" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
							</div>
							<div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
								<img src="assets/img/plan2.jpg" alt="" class="img-fluid">
							</div>
							<div class="tab-pane fade" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.1422937950147!2d-73.98731968482413!3d40.75889497932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes+Square!5e0!3m2!1ses-419!2sve!4v1510329142834" width="100%" height="460" frameborder="0" style="border:0" allowfullscreen></iframe>
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