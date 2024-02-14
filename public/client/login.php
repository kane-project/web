<?php
    
    require_once("lib/Users.php");
    session_start();

    if(isset($_SESSION['uid'])) {
        die(header("Location: /account"));
    }

    if(isset($_POST['login'])) {
        
        if(user_login($_POST['email'], $_POST['password'])) 
        {
            $uid = get_user_id_from_email($_POST['email']);
            $user = new User($uid);
            
            if($user->is_email_verified == 0) {
                $suid = urlencode(encryptUserID($user->id));
                die(header("Location: /account/login?uv=1&suid=$suid"));
            }

            if($user->is_banned == 1) {
                die(header("Location: /account/login?be=1"));
            }

            if($user->user_type == 1) {
                die(header("Location: /account/login?ae=1"));
            }
            
            $_SESSION['uid'] = $user->id;
            header("Location: /account");
        } 
        
        else {
            die(header("Location: /account/login?ae=fail"));
        }

    }

    $page = "Login";
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
							<h1 class="title-single">Account Login</h1>
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
                                <form action="/account/login" method="POST">
                                    <?php
                                        
                                        if(isset($_GET['ae'])) {
                                            echo '
                                                <div class="mb-3">
                                                    <div class="alert alert-warning rounded-0">
                                                        <i class="fa fa-info-circle"></i>&nbsp; Error: Incorrect email or password.
                                                    </div>
                                                </div>
                                            ';
                                        }

                                        if(isset($_GET['be'])) {
                                            echo '
                                                <div class="mb-3">
                                                    <div class="alert bg-danger text-light rounded-0">
                                                        <i class="fa fa-info-circle"></i>&nbsp; Error: You are banned. Please contact support.
                                                    </div>
                                                </div>
                                            ';
                                        }

                                        if(isset($_GET['uv'])) {

                                            $userID = isset($_GET['suid']) ? $_GET['suid'] : die(header("Location: /portal/login"));

                                            echo '
                                                <div class="mb-3">
                                                    <div class="alert bg-primary text-light rounded-0">
                                                        <i class="fa fa-info-circle"></i>&nbsp; Please verify your email before logging in. 
                                                        Don\'t forget to check your spam folder.
                                                        <div class="mt-3">
                                                            <a class="btn rounded-0 btn-sm btn-light" href="/resend-email/'.$_GET['suid'].'" class="text-primary">Resend Email</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            ';
                                        }
                                        
                                        if(isset($_GET['ls'])) {
                                            echo '
                                                <div class="mb-3">
                                                    <div class="alert bg-success text-light rounded-0">
                                                        <i class="fa fa-info-circle"></i>&nbsp; You\'ve been logged out successfully.
                                                    </div>
                                                </div>
                                            ';
                                        }

                                        if(isset($_GET['vs'])) {
                                            echo '
                                                <div class="mb-3">
                                                    <div class="alert bg-success text-light rounded-0">
                                                        <i class="fa fa-info-circle"></i>&nbsp; Your email has been verified successfully. Please login.
                                                    </div>
                                                </div>
                                            ';
                                        }

                                        if(isset($_GET['ess'])) {
                                            echo '
                                                <div class="mb-3">
                                                    <div class="alert bg-success text-light rounded-0">
                                                        <i class="fa fa-info-circle"></i>&nbsp; Verification email resent successfully.<br>
                                                        Please don\'t forget to check your spam folder.
                                                    </div>
                                                </div>
                                            ';
                                        }
                                        
                                    ?>
                                    <div class="mb-3">
                                        <label for="email" class="mb-2">Email</label>
                                        <input type="email" name="email" id="email" class="form-control rounded-0" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="mb-2">Password</label>
                                        <input type="password" name="password" id="password" class="form-control rounded-0" required>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <button type="submit" name="login" class="btn col-8 btn-dark rounded-0">Login</button>
                                        <br>
                                        <div class="mt-2">
                                            <a href="/account/reset-password" class="mt-2 text-primary">Forgot Password?</a> |
                                            <a href="/account/register" class="mt-2 text-primary">Register Account</a>
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