<?php

	require_once("lib/Users.php");

	// Process Login
	if(isset($_POST['submit']))
	{
		//...
	}

	$page = "Portal Login";
	include("header.php");

?>

<body>

	<main id="main">

		<div class="container py-5">
			<div class="row py-5 justify-content-center">
				<div class="col-md-9 py-3 mx-auto">
					<div class="card p-3 rounded-0 shadow">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6 d-none d-md-block">
									<div class="mb-3 text-center">
										<img src="assets/img/logo.png" class="img-fluid" alt="">
									</div>
								</div>
								<div class="col-md-6">
									<h5 class="card-title text-center">Portal Login</h5>
									<form method="POST" action="portal/login">
										<?php
											if(isset($_GET['le'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert alert-warning rounded-0">
														Error - Invalid credentials. Please try again.
													</div>
												</div>';
											}

											if(isset($_GET['e'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert alert-danger rounded-0">
														Fatal Error! Please contact the site administrator.
													</div>
												</div>';
											}

											if(isset($_GET['uv'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert alert-warning rounded-0">
														Please verify your email address. 
														Don\'t forget to check your spam folder!
														<br><br>
														<a href="portal/resend-email/{userid}">Resend Email</a>
													</div>
												</div>';
											}
										?>
										<div class="mb-3 p-1">
											<label for="email" class="form-label">Email Address</label>
											<input name="email" type="email" required class="form-control rounded-0" id="email" placeholder="Enter email">
										</div>
										<div class="mb-3 p-1">
											<label for="password" class="form-label">Password</label>
											<input name="password" type="password" required class="form-control rounded-0" id="password" placeholder="Enter password">
										</div>
										<div class="mb-3 p-1 text-center">
											<button name="submit" type="submit" class="btn col-6 rounded-0 btn-primary">Login</button>
										</div>
										<div class="mb-3 p-1">
											<a href="portal/reset-password">Forgot Password?</a> |
											<a href="portal/register">Register</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</main>

	<?php include("footer.php"); ?>

</body>
</html>