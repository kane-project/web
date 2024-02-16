<?php
    
    require_once("lib/Users.php");
    session_start();

    if(isset($_SESSION['uid'])) {
        die(header("Location: /account"));
    }

    if(isset($_POST['register'])) 
    {
        //...
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
                                            Already registered? <a href="/reset-password" class="mt-2 text-primary">Login</a>
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

</body>
</html>