<?php 

	session_start();

	$page = "About";
	include("header.php"); 
?>

<body>

	<?php include("navbar.php"); ?>

	<main id="main">

		<section class="intro-single">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="title-single-box">
							<h1 class="title-single">Empowering New Communities & Individuals</h1>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="section-about">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 position-relative">
						<div class="about-img-box">
							<img src="assets/img/slide-about-1.jpg" alt="" class="img-fluid">
						</div>
						<div class="sinse-box">
							<h3 class="sinse-title text-light">
								Introducing
								<br> The KANE Project
							</h3>
						</div>
					</div>
					<div class="col-md-12 section-t8 position-relative">
						<div class="row">
							<div class="col-md-6 col-lg-5">
								<img src="assets/img/about-2.jpg" alt="" class="img-fluid">
							</div>
							<div class="col-lg-2  d-none d-lg-block position-relative">
								<div class="title-vertical d-flex justify-content-start">
									<span>EstateAgency Exclusive Property</span>
								</div>
							</div>
							<div class="col-md-6 col-lg-5 section-md-t3">
								<div class="title-box-d">
									<h3 class="title-d">Sed
										<span class="color-d">porttitor</span> lectus
										<br> nibh.
									</h3>
								</div>
								<p class="color-text-a">
									Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vivamus magna justo, lacinia eget
									consectetur sed, convallis
									at tellus. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum
									ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit
									neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
								</p>
								<p class="color-text-a">
									Sed porttitor lectus nibh. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus.
									Mauris blandit aliquet
									elit, eget tincidunt nibh pulvinar a. Vivamus magna justo, lacinia eget consectetur sed,
									convallis at tellus.
								</p>
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