<?php
    
    require_once("lib/Users.php");
    session_start();
    loadEnv();

    if(isset($_SESSION['uid'])) {
        die(header("Location: /account"));
    }

    if(isset($_POST['register'])) 
    {
		$errors = "?ecf=1";

		if($_POST['password'] != $_POST['password2'])
			$errors .= "&pe=1&";

		if(is_email_phone_registered($_POST["email"], $_POST["phone"]))
			$errors .= "&ar=1&";

        $profile_pic = "";

		if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) 
            $profile_pic = upload_user_photo($_FILES['profile_photo']);

		if($profile_pic == "ERROR") 
			$errors .= "&pfe=1&";

		$user = new User;
		$user->user_type = 0;
		$user->id = generate_uuid();
		$user->first_name = $_POST['first_name'];
		$user->last_name = $_POST['last_name'];
		$user->email = $_POST['email'];
		$user->phone = $_POST['phone'];
		$user->address = $_POST['address'];
		$user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$user->is_email_verified = 0;
		$user->profile_photo = $profile_pic;
		$user->timestamp = time();
		$user->is_banned = 0;

		if($errors != '?ecf=1') 
			die(header("Location: /account/register" . $errors));
		else 
		{
			if(!register_user($user)) {
				delete_user_photo($profile_pic);
				die(header("Location: /account/register?e=1"));
			} 
            
            if(isset($_POST['newsletter'])) {
                if(!add_to_emailist($user->id, $user->email)) {
                    error_log("Failed to add user to email list: " . $user->id . " - " . $user->email);
                }
            }

			die(header("Location: /account/login?rs=1"));
		}
    }

    $page = "Register";
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
							<h1 class="title-single">Register Account</h1>
						</div>
					</div>
				</div>
			</div>
		</section>

        <section class="section-about">
			<div class="container">
				<div class="row">
                    <div class="col-lg-6 mx-auto">
                        <div class="card rounded-0 shadow">
                            <div class="card-body">
                                <form action="/account/register" method="POST">
                                    <?php
                                        
                                        if(isset($_GET['e'])) {
                                            echo '
                                                <div class="mb-3">
                                                    <div class="alert bg-danger text-light rounded-0">
                                                        <i class="fa fa-info-circle"></i>&nbsp; System Error - Please contact support immediately.
                                                    </div>
                                                </div>
                                            ';
                                        }

                                        if(isset($_GET['pe'])) {
                                            echo '
                                                <div class="mb-3">
                                                    <div class="alert alert-warning rounded-0">
                                                        <i class="fa fa-info-circle"></i>&nbsp; Passwords don\'t match.
                                                    </div>
                                                </div>
                                            ';
                                        }

                                        if(isset($_GET['ar'])) {
                                            echo '
                                                <div class="mb-3">
                                                    <div class="alert alert-warning rounded-0">
                                                        <i class="fa fa-info-circle"></i>&nbsp; Email or phone number already registered.
                                                    </div>
                                                </div>
                                            ';
                                        }

                                        if(isset($_GET['pfe'])) {
                                            echo '
                                                <div class="mb-3">
                                                    <div class="alert alert-warning rounded-0">
                                                        <i class="fa fa-info-circle"></i>&nbsp; Failed to upload profile photo. Please try again.
                                                    </div>
                                                </div>
                                            ';
                                        }
                                    
                                    ?>
                                    <div class="mb-3">
                                        <label for="first_name" class="mb-2">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control rounded-0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="mb-2">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control rounded-0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="mb-2">Email</label>
                                        <input type="email" name="email" id="email" class="form-control rounded-0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="mb-2">Password</label>
                                        <input type="password" name="password" id="password" class="form-control rounded-0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password2" class="mb-2">Confirm Password</label>
                                        <input type="password" name="password2" id="password2" class="form-control rounded-0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone" class="mb-2">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control rounded-0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="mb-2">Address</label>
                                        <input type="text" name="address" id="address" class="form-control rounded-0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="profile_photo" class="mb-2">Profile Photo (optional)</label>
                                        <input type="file" name="profile_photo" id="profile_photo" class="form-control rounded-0">
                                    </div>
                                    <div class="mb-5">
                                        <div class="p-1">
                                            <input type="checkbox" name="legalese" required> I accept the <a target="_blank" href="/legal/terms" class="text-primary">Terms of Use</a> and
                                            <a target="_blank" href="/legal/privacy" class="text-primary">Privacy Policy</a>.
                                        </div>
                                        <div class="p-1">
                                            <input type="checkbox" checked name="newsletter"> Sign me up to get the latest listings and news via email.
                                        </div>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <button type="submit" name="register" class="btn col-8 btn-dark rounded-0">Register</button>
                                        <br>
                                        <div class="mt-2">
                                            Already registered? <a href="/account/login" class="mt-2 text-primary">Login</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include("footer.php"); ?>
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