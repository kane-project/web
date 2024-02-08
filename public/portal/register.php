<?php

    require_once("lib/Users.php");
    session_start();

    if(isset($_SESSION['landlord_id']))
        die(header("Location: /portal"));

    $page = "Register";
    include("header.php");  
?>
<body>

    <main id="main">
        <div class="container py-5">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-sm-12 py-5 mx-auto">
					<div class="card p-3 rounded-0 shadow">
						<div class="card-body">
							<div class="row">
								<div class="mx-auto">
									<h5 class="card-title text-center">Register Account</h5>
									<form method="POST" action="portal/register" enctype="multipart/form-data">

										<?php

											if(isset($_GET['e'])) {
												echo '<div class="mb-1 p-1">
													<div class="alert bg-danger text-light rounded-0">
														<i class="fas fa-exclamation-triangle"></i>&nbsp; System error. Please contact support.
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
											<button name="submit" type="submit" class="btn col-6 rounded-0 btn-primary">Register</button>
										</div>
										<div class="mb-3 text-center">
											Already registered? <a class="text-primary" href="portal/login">Login</a>
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