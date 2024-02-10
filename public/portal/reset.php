<?php

    require_once("lib/Users.php");

    if(isset($_POST['send_reset_link']))
    {
        if(!is_email_phone_registered($_POST['email'], ""))
            die(header("Location: /portal/reset-password/?nr=1"));
        
        if(check_reset_link($_POST["email"]))
            die(header("Location: /portal/reset-password/?as=1"));

        else 
        {
            $linkid = add_reset_link($_POST['email']);
            send_reset_email(1, $_POST['email'], $linkid);
            die(header("Location: /portal/login/?prs=1"));
        }
    }

    $page = "Reset Password";
    include("header.php");
?>
<body>

    <main>
        
        <section class="container py-5">
            <div class="row py-3">
                <div class="col-lg-12 py-2 mx-auto text-center">
                    <h1>Forgot Your Password?</h1>
                </div>
                <div class="col-lg-6 py-2 mx-auto ">
                    <form action="/portal/reset-password" method="post">
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
                        <div class="mt-3 text-center">
                            <a class="text-primary" href="/portal/login">&larr; Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main>

</body>
</html>