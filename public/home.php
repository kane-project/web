<?php $page = "home";
include("header.php"); ?>

<body>

	<?php include("navbar.php"); ?>

	<div class="intro intro-carousel swiper position-relative">
		<div class="swiper-wrapper">
			<div class="swiper-slide carousel-item-a intro-item bg-image" style="background-image: url(assets/img/slide-1.jpg)">
				<div class="overlay overlay-a"></div>
				<div class="intro-content display-table">
					<div class="table-cell">
						<div class="container">
							<div class="row">
								<div class="col-lg-8">
									<div class="intro-body">
										<h1 class="intro-title mb-4 ">
											Empowering
											<br> Newcomers & Immigrants
										</h1>
										<p class="lead">
											We are a rental listing service catering to newcomers in Canada.
										</p>
										<p class="intro-subtitle intro-price">
											<a href="about"><span class="price-a">About Our Project</span></a>
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<main id="main">

		<section class="section-services section-t8">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title-wrap d-flex justify-content-between">
							<div class="title-box">
								<h2 class="title-a">Our Services</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="card-box-c foo">
							<div class="card-header-c d-flex">
								<div class="card-box-ico">
									<span class="bi bi-house"></span>
								</div>
								<div class="card-title-c align-self-center">
									<h2 class="title-c">Find Rentals</h2>
								</div>
							</div>
							<div class="card-body-c">
								<p class="content-c">
									Find rentals specifically listed for newcomers to Canada.
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card-box-c foo">
							<div class="card-header-c d-flex">
								<div class="card-box-ico">
									<span class="bi bi-calendar4-week"></span>
								</div>
								<div class="card-title-c align-self-center">
									<h2 class="title-c">List Your Properties</h2>
								</div>
							</div>
							<div class="card-body-c">
								<p class="content-c">
									Planning to rent your properties to newcomers? List your properties with us.
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card-box-c foo">
							<div class="card-header-c d-flex">
								<div class="card-box-ico">
									<span class="bi bi-search"></span>
								</div>
								<div class="card-title-c align-self-center">
									<h2 class="title-c">Easy Search</h2>
								</div>
							</div>
							<div class="card-body-c">
								<p class="content-c">
									Find properties based on your preferences and requirements.
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="section-property section-t8">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="title-wrap d-flex justify-content-between">
							<div class="title-box">
								<h2 class="title-a">Latest Listings</h2>
							</div>
							<div class="title-link">
								<a href="listings">View All
									<span class="bi bi-chevron-right"></span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div id="property-carousel" class="swiper">
					<div class="swiper-wrapper">

						<div class="carousel-item-b swiper-slide">
							<div class="card-box-a card-shadow">
								<div class="img-box-a">
									<img src="assets/img/property-6.jpg" alt="" class="img-a img-fluid">
								</div>
								<div class="card-overlay">
									<div class="card-overlay-a-content">
										<div class="card-header-a">
											<h2 class="card-title-a">
												<a href="property-single.html">206 Mount
													<br /> Olive Road Two</a>
											</h2>
										</div>
										<div class="card-body-a">
											<div class="price-box d-flex">
												<span class="price-a">rent | $ 12.000</span>
											</div>
											<a href="#" class="link-a">Click here to view
												<span class="bi bi-chevron-right"></span>
											</a>
										</div>
										<div class="card-footer-a">
											<ul class="card-info d-flex justify-content-around">
												<li>
													<h4 class="card-info-title text-light">Area</h4>
													<span>340m
														<sup>2</sup>
													</span>
												</li>
												<li>
													<h4 class="card-info-title text-light">Beds</h4>
													<span>2</span>
												</li>
												<li>
													<h4 class="card-info-title text-light">Baths</h4>
													<span>4</span>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="carousel-item-b swiper-slide">
							<div class="card-box-a card-shadow">
								<div class="img-box-a">
									<img src="assets/img/property-3.jpg" alt="" class="img-a img-fluid">
								</div>
								<div class="card-overlay">
									<div class="card-overlay-a-content">
										<div class="card-header-a">
											<h2 class="card-title-a">
												<a href="property-single.html">157 West
													<br /> Central Park</a>
											</h2>
										</div>
										<div class="card-body-a">
											<div class="price-box d-flex">
												<span class="price-a">rent | $ 12.000</span>
											</div>
											<a href="property-single.html" class="link-a">Click here to view
												<span class="bi bi-chevron-right"></span>
											</a>
										</div>
										<div class="card-footer-a">
											<ul class="card-info d-flex justify-content-around">
												<li>
													<h4 class="card-info-title">Area</h4>
													<span>340m
														<sup>2</sup>
													</span>
												</li>
												<li>
													<h4 class="card-info-title">Beds</h4>
													<span>2</span>
												</li>
												<li>
													<h4 class="card-info-title">Baths</h4>
													<span>4</span>
												</li>
												<li>
													<h4 class="card-info-title">Garages</h4>
													<span>1</span>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="propery-carousel-pagination carousel-pagination"></div>

			</div>
		</section>

	</main>

	<?php include("footer.php"); ?>

</body>
</html>