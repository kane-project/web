<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");
    require_once("lib/Messaging.php");

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

    $page = "Account Settings";
    $user = new User($_SESSION['landlord_id']);
    include("header.php");

    if (isset($_POST['update_info'])) {
		if (!is_email_phone_registered('NULL', $_POST['phone'])) {
			$user->first_name = $_POST['first_name'];
			$user->last_name = $_POST['last_name'];
			$user->address = $_POST['address'];
			$user->phone = $_POST['phone'];
			update_user($user->id, $user);
			die(header("Location: /portal/settings/?uis=1"));
		}

		// Again, I hate redundant code, but I'm not sure how to refactor this without breaking the logic.
		elseif ($user->phone == $_POST['phone']) {
			$user->first_name = $_POST['first_name'];
			$user->last_name = $_POST['last_name'];
			$user->address = $_POST['address'];
			$user->phone = $_POST['phone'];
			update_user($user->id, $user);
			die(header("Location: /portal/settings/?uis=1"));
		} else {
			die(header("Location: /portal/settings/?phne=1"));
		}
	}

	if (isset($_POST['update_password'])) {
		if ($_POST['new_password'] == $_POST['confirm_password']) {
			if (password_verify($_POST['password'], $user->password)) {
				$user->password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
				update_user($user->id, $user);
				die(header("Location: /portal/settings/?upwd=1"));
			} else {
				die(header("Location: /portal/settings/?opwd=1"));
			}
		} else {
			die(header("Location: /portal/settings/?cpwd=1"));
		}
	}

?>
<body>

    <?php include("navbar.php"); ?>

    <main class="mb-5">
        
        <section class="container">
            <div class="row py-1">
                <div class="col-lg-12 py-2 mx-auto text-center">
                    <h1>Account Settings</h1>
                </div>
            </div>
        </section>

        <section class="container">
            <div class="row py-1">
                <div class="col-lg-6 py-2">
                    <div class="card shadow rounded-0 p-3">
                        <div class="mb-3">
                            <form action="/portal/settings" method="POST">
                                <div class="mb-3">
                                    <h3>Update Account Information</h3>
                                </div>
                                <?php
                                if (isset($_GET['phne'])) {
                                    echo '<div class="alert alert-warning rounded-0">Error: Phone number is already registered.</div>';
                                }
                                if (isset($_GET['uis'])) {
                                    echo '<div class="alert alert-success rounded-0">Success: Account information updated.</div>';
                                }
                                ?>
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control rounded-0" id="first_name" name="first_name" value="<?php echo $user->first_name; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control rounded-0" id="last_name" name="last_name" value="<?php echo $user->last_name; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control rounded-0" id="phone" name="phone" value="<?php echo $user->phone; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control rounded-0" id="address" name="address" value="<?php echo $user->address; ?>">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_info" class="btn rounded-0 col-12 btn-dark">Update Account Info</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 py-2">
                    <div class="card shadow rounded-0">
                        <div class="card-body">
                            <div class="mb-4">
                                <form action="/portal/settings" method="post">
                                    <div class="mb-3">
                                        <h3>Update Password</h3>
                                    </div>
                                    <?php
                                    if (isset($_GET['upwd'])) {
                                        echo '<div class="alert alert-success rounded-0">Success: Password updated.</div>';
                                    }

                                    if (isset($_GET['cpwd'])) {
                                        echo '<div class="alert alert-warning rounded-0">Error: Passwords don\'t match</div>';
                                    }

                                    if (isset($_GET['opwd'])) {
                                        echo '<div class="alert alert-warning rounded-0">Error: Incorrect old password provided.</div>';
                                    }
                                    ?>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Old Password</label>
                                        <input type="password" class="form-control rounded-0" id="password" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input type="password" class="form-control rounded-0" id="new_password" name="new_password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control rounded-0" id="confirm_password" name="confirm_password">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_password" class="btn rounded-0 col-12 btn-dark">Update Password</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mt-3">
                                <h3 class="card-title">Danger Zone</h3>
                                <div class="mt-3">
                                    <a href="#" class="btn rounded-0 col-12 btn-danger" id="deleteAccountBtn" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete Your Account</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Account Deletion</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Are you sure you want to delete your account? This action cannot be undone. You will lose:
					<ul>
						<li>Your account information</li>
						<li>Your posted listings</li>
						<li>Purchased sponsorship tiers</li>
						<li>Access to messaging</li>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Cancel</button>
					<form id="deleteAccountForm" method="POST" action="/portal/delete-account">
						<input type="hidden" name="suid" value="<?php echo encryptUserID($user->id); ?>">
						<button type="submit" class="btn btn-danger rounded-0">Delete Account</button>
					</form>
				</div>
			</div>
		</div>
	</div>

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