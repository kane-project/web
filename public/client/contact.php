<?php 
	
	require_once("lib/Emails.php");
	require_once("lib/Users.php");

	session_start();
	$page = "Contact";
	include("header.php"); 

	if(isset($_POST['send_message']))
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		if(send_internal_email($name, $email, $subject, $message))
			die(header("Location: /contact/?s=1#contact-form"));
		else
			die(header("Location: /contact/?e=1#contact-form"));
	}

?>

<body>

	<?php include("navbar.php"); ?>

	<main id="main">

		<section class="intro-single">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-8">
						<div class="title-single-box">
							<h1 class="title-single">Contact Us</h1>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="contact" id="contact-form">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="contact-map box">
							<div id="map" class="contact-map">
								<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.655242675809!2d-79.41339582344423!3d43.67613945094626!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x882b349c7b2e07d1%3A0x78fafe8ff1bee19d!2s160%20Kendal%20Ave%2C%20Toronto%2C%20ON%20M5T%202T9!5e0!3m2!1sen!2sca!4v1707421405594!5m2!1sen!2sca" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
							</div>
						</div>
					</div>

					<div class="col-sm-12 section-t8">
						<div class="row">
							<div class="col-md-7">
								<form action="/contact" method="POST" role="form">
									<div class="row">
										<?php 
											if(isset($_GET['s']))
												echo '
												<div class="col-md-12">
													<div class="alert bg-success text-light rounded-0" role="alert">
														<strong>Success!</strong> Your message has been sent.
													</div>
												</div>
											';
												
										?>
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<input type="text" name="name" class="form-control rounded-0" placeholder="Your Name" required>
											</div>
										</div>
										<div class="col-md-6 mb-3">
											<div class="form-group">
												<input name="email" type="email" class="form-control rounded-0" placeholder="Your Email" required>
											</div>
										</div>
										<div class="col-md-12 mb-3">
											<div class="form-group">
												<input type="text" name="subject" class="form-control rounded-0" placeholder="Subject" required>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<textarea name="message" style="resize:none;" class="form-control rounded-0" name="message" cols="45" rows="8" placeholder="Message" required></textarea>
											</div>
										</div>
										<div class="col-md-12 mt-3 text-center">
											<button type="submit" name="send_message" class="btn rounded-0 btn-lg btn-outline-dark">Send Message</button>
										</div>
									</div>
								</form>
							</div>
							<div class="col-md-5 section-md-t3">
								<div class="icon-box section-b2">
									<div class="icon-box-icon">
										<span class="bi bi-envelope"></span>
									</div>
									<div class="icon-box-content table-cell">
										<div class="icon-box-title">
											<h4 class="icon-title">Say Hello</h4>
										</div>
										<div class="icon-box-content">
											<p class="mb-1">Email -
												<span class="color-a">info@kaneproject.ca</span>
											</p>
											<p class="mb-1">Phone -
												<span class="color-a">(647) 000-0000</span>
											</p>
										</div>
									</div>
								</div>
								<div class="icon-box section-b2">
									<div class="icon-box-icon">
										<span class="bi bi-geo-alt"></span>
									</div>
									<div class="icon-box-content table-cell">
										<div class="icon-box-title">
											<h4 class="icon-title">Main Office</h4>
										</div>
										<div class="icon-box-content">
											<p class="mb-1">
												160 Kendal Ave, Toronto, ON
											</p>
										</div>
									</div>
								</div>
								<div class="icon-box">
									<div class="icon-box-icon">
										<span class="bi bi-share"></span>
									</div>
									<div class="icon-box-content table-cell">
										<div class="icon-box-title">
											<h4 class="icon-title">Let's Connect</h4>
										</div>
										<div class="icon-box-content">
											<div class="socials-footer">
												<ul class="list-inline">
													<li class="list-inline-item">
														<a href="#" class="link-one">
															<i class="bi bi-facebook" aria-hidden="true"></i>
														</a>
													</li>
													<li class="list-inline-item">
														<a href="#" class="link-one">
															<i class="bi bi-twitter" aria-hidden="true"></i>
														</a>
													</li>
													<li class="list-inline-item">
														<a href="#" class="link-one">
															<i class="bi bi-instagram" aria-hidden="true"></i>
														</a>
													</li>
													<li class="list-inline-item">
														<a href="#" class="link-one">
															<i class="bi bi-linkedin" aria-hidden="true"></i>
														</a>
													</li>
												</ul>
											</div>
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