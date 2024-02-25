<?php 
    require_once("lib/Users.php");
	session_start();

    if(isset($_SESSION['uid'])) {
        die(header("Location: /account"));
    }

    if(isset($_POST['send_reset_link']))
    {
        if(!is_email_phone_registered($_POST['email'], ""))
            die(header("Location: /reset-password/?nr=1"));
        
        if(check_reset_link($_POST["email"]))
            die(header("Location: /reset-password/?as=1"));

        else 
        {
            $linkid = add_reset_link($_POST['email']);
            send_reset_email(0, $_POST['email'], $linkid);
            die(header("Location: /account/login/?prs=1"));
        }
    }

	$page = "Reset Your Password";
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
							<h1 class="title-single">Forgot Your Password?</h1>
                            <a class="text-primary" href="/account/login">&larr; Back to Login</a>
						</div>
					</div>

                    <div class="col-lg-6 py-5 mt-3 mx-auto">
                        <form action="/reset-password" method="post">
                            <?php 
                                if(isset($_GET['nr']))
                                    echo '
                                        <div class="alert bg-danger text-light rounded-0">
                                            <i class="fa fa-exclamation-triangle"></i>&nbsp; Email address not registered.
                                        </div>
                                ';

                                if(isset($_GET['as']))
                                    echo '
                                        <div class="alert alert-warning rounded-0">
                                            <i class="fa fa-exclamation-triangle"></i>&nbsp; Reset email already sent. Please check your spam folder.
                                        </div>
                                ';
                            ?>
                            <div class="mb-3">
                                <label for="email" class="mb-2">Enter your email address and we'll send you a reset link.</label>
                                <input type="email" class="form-control rounded-0" id="email" name="email" required>
                            </div>
                            <div class="mt-1 mx-auto text-center">
                                <button type="submit" name="send_reset_link" class="btn rounded-0 col-9 btn-dark">Reset Password</button>
                            </div>
                        </form>
                    </div>
				</div>
			</div>
		</section>

		
		
	</main>

	<?php include("footer.php"); ?>

</body>
</html>