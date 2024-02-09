<?php

    require_once("lib/Users.php");
    session_start();
	loadEnv();

    if(isset($_SESSION['landlord_id']))
        die(header("Location: /portal"));

	if(isset($_POST['submit'])) 
	{
		$user = new User;
	}


    $page = "Register";
    include("header.php");  
?>
<body>

    <main id="main">
        <div class="container py-5">
			<div class="row justify-content-center">
				<div class="col-lg-6 col-sm-12 py-5 mx-auto">
					<div class="card p-33 rounded-0 shadow">
						<div class="card-body">
							<div class="row">
								<div class="mx-auto">
									<h5 class="card-title text-center">Property Owner Registration</h5>
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
											<label for="name" class="form-label">First Name</label>
											<input name="first_name" type="text" required class="form-control rounded-0" id="name" placeholder="Enter first name">
										</div>
										<div class="mb-3 p-1">
											<label for="name" class="form-label">Last Name</label>
											<input name="last_name" type="text" required class="form-control rounded-0" id="name" placeholder="Enter last name">
										</div>
										<div class="mb-3 p-1">
											<label for="email" class="form-label">Email Address</label>
											<input name="email" type="email" required class="form-control rounded-0" id="email" placeholder="Enter email">
										</div>
										<div class="mb-3 p-1">
											<label for="password" class="form-label">Password</label>
											<input name="password" type="password" required class="form-control rounded-0" id="password" placeholder="Enter password">
										</div>
										<div class="mb-3 p-1">
											<label for="password" class="form-label">Confirm Password</label>
											<input name="confirm_password" type="password" required class="form-control rounded-0" id="password" placeholder="Confirm password">
										</div>
										<div class="mb-3 p-1">
											<label for="phone" class="form-label">Phone Number</label>
											<input name="phone" type="text" required class="form-control rounded-0" id="phone" placeholder="Enter phone number">
										</div>
										<div class="mb-3 p-1">
											<label for="address" class="form-label">Address</label>
											<input name="address" type="text" required class="form-control rounded-0" id="address" placeholder="Enter address">
										</div>
										<div class="mb-3 p-1">
											<label for="profile_pic" class="form-label">Profile Picture (optional)</label>
											<input name="profile_pic" type="file" class="form-control rounded-0" id="profile_pic">
										</div>
										<div class="mb-3 p-1">
											<input name="legal" type="checkbox" required class="form-check-input" id="legal">
											<label class="form-check-label" for="privacy_policy">I agree with the 
											<a class="text-primary" target="_blank" href="/legal/terms">Terms of Use</a> 
											and <a class="text-primary" target="_blank" href="/legal/privacy">Privacy Policy</a></label>
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

	<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_ENV['GOOGLE_MAPS_API_KEY']; ?>&libraries=places"></script>
	<script>
		// Google Maps API
        
        function initialize() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input, {
                types: ['geocode'],
                componentRestrictions: {
                    country: 'CA'
                }
            });
        }

        document.addEventListener('DOMContentLoaded', initialize);
	</script>

</body>
</html>