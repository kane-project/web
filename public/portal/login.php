<?php

	require_once("lib/Users.php");
	session_start();

	if(isset($_SESSION['landlord_id']))
		die(header("Location: /portal"));

	// Process Login
	if(isset($_POST['submit']))
	{
		$user = user_login($_POST['email'], $_POST['password']);

		if (/*AUTH*/$user && /*CHECK LANDLORDNESS=>*/ $user->user_type && /*VERIF*/$user->is_email_verified && /*ISBAN*/ !$user->is_banned) {
			$_SESSION['landlord_id'] = $user->id;
			header("Location: /portal");
		} elseif (!$user) {
			header("Location: /portal/login?le=1");
		} elseif (!$user->is_email_verified) {
			$suid = urlencode(encryptUserID($user->id));
			die(header("Location: /portal/login?uv=1&suid=$suid"));
		} elseif ($user->is_banned) {
			header("Location: /portal/login?be=1");
		} elseif (!$user->user_type) {
			header("Location: /portal/login?le=1");
		} else {
			header("Location: /portal/login?e");
		}
	}

	$page = "Portal Login";
	include("header.php");

?>

<body>

	<main id="main">

		<div class="container py-5">
			<div class="row justify-content-center">
				<div class="col-lg-9 col-sm-12 py-5 mx-auto">

					<div class="card p-3 rounded-0 shadow">
						<div class="card-body">
							<div class="row">
								<div class="col-md-6 col-sm-12 d-none d-md-block">
									<div class="mb-3 text-center">
										<img src="assets/img/logo.png" class="img-fluid" alt="">
									</div>
								</div>
								<div class="col-md-6 col-sm-12">
									<h5 class="card-title text-center">Portal Login</h5>
									<?php if(empty($_GET)) echo '<div class="alert p-2 rounded-0 alert-secondary"><i class="fa fa-info-circle"></i>
									&nbsp; This portal is for property owners. &nbsp;<a class="btn btn-sm btn-light" href="/account/login">Client Login</a>
									</div>'; ?>
									<form method="POST" action="portal/login">
										<?php
											if(isset($_GET['le'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert alert-warning rounded-0">
													 	<i class="fas fa-exclamation-triangle"></i>&nbsp; Error - Invalid credentials. Please try again.
													</div>
												</div>';
											}

											if(isset($_GET['e'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert bg-danger text-light rounded-0">
														<i class="fas fa-exclamation-triangle"></i>&nbsp; System error. Please contact support.
													</div>
												</div>';
											}

											if(isset($_GET['be'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert bg-danger text-light rounded-0">
														<i class="fas fa-exclamation-triangle"></i>&nbsp; Error - Your account has been banned.<br>
														Please contact support for more information.
													</div>
												</div>';
											}

											if(isset($_GET['uv'])) {
												$userID = isset($_GET['suid']) ? $_GET['suid'] : die(header("Location: /portal/login"));

												echo '<div class="mb-1 p-1">
													<div class="alert bg-primary text-light rounded-0">
													 	<i class="fa fa-info-circle"></i> Please verify your email address. Don\'t forget to check your spam folder!
														<div class="mt-3">
															<a class="btn btn-sm btn-light p-2 rounded-0" href="portal/resend-email/'.$_GET['suid'].'">Resend Email</a>
														</div>
													</div>
												</div>';
											}

											if(isset($_GET['ls'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert bg-success text-light rounded-0">
														<i class="fa fa-info-circle"></i> You\'ve been logged out successfully.
													</div>
												</div>';
											}

											if(isset($_GET['rs'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert bg-success text-light rounded-0">
														<i class="fa fa-info-circle"></i> You\'ve been registered successfully.<br><br>
														Please verify your email address to login. We\'ve sent you an email.
														Don\'t forget to check your spam folder!
													</div>
												</div>';
											}

											if(isset($_GET['cs'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert bg-success text-light rounded-0">
														<i class="fa fa-info-circle"></i> Email address confirmed successfully! Please login.
													</div>
												</div>';
											}

											if(isset($_GET['ess'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert bg-primary text-light rounded-0">
														<i class="fa fa-info-circle"></i> Email resent. Please check your email. Don\'t forget to check your spam folder!
													</div>
												</div>';
											}

											if(isset($_GET['prs'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert bg-primary text-light rounded-0">
														<i class="fa fa-info-circle"></i> Password reset link sent. Please check your email. Don\'t forget to check your spam folder!
													</div>
												</div>';
											}

											if(isset($_GET['ps'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert bg-success text-light rounded-0">
														<i class="fa fa-info-circle"></i> Password reset successfully! Please login.
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
										<div class="mb-3 text-center">
											<a href="portal/reset-password">Forgot Password?</a> |
											<a href="portal/register">Create Account</a>
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


</body>
</html>