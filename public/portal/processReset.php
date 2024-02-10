<?php

    require_once("lib/Users.php");

    $email = get_reset_requesters_email($resetid);

    if(empty($email))
        die(header("Location: /404"));

    $uid = get_user_id_from_email($email);
    if(empty($uid)) die(header("Location: /portal/reset-password/?nr=1"));

    if(isset($_POST['reset_password']))
    {
        if($_POST['password'] != $_POST['confirm_password'])
            die(header("Location: /portal/reset/$resetid/?pe=1"));

        $user = new User($uid);
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        update_user($uid, $user);
        delete_reset_request($resetid);
        die(header("Location: /portal/login?ps=1"));
    }

    $page = "Reset Password";
    
    include("header.php");
?>
<body>

    <main>
        
        <section class="container py-5">
            <div class="row py-3">
                <div class="col-lg-12 py-2 mx-auto text-center">
                    <h1>Reset Your Password</h1>
                </div>
                <div class="col-lg-6 mx-auto">
                    <div class="card p-2 shadow rounded-0">
                        <div class="card-body">
                            <form action="/portal/reset/<?php echo $resetid ?>" method="POST">
                                <?php
                                    if(isset($_GET["pe"])) {
                                        echo '
                                            <div class="alert alert-warning rounded-0">
                                                <i class="fa fa-exclamation-triangle"></i>&nbsp; Error: Passwords do not match.
                                            </div>
                                        ';
                                    }
                                ?>
                                <div class="mb-3">
                                    <label for="password" class="mb-2">Enter your new password</label>
                                    <input type="password" minlength="8" class="form-control rounded-0" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirm_password" class="mb-2">Confirm your new password</label>
                                    <input type="password" minlength="8" class="form-control rounded-0" id="confirm_password" name="confirm_password" required>
                                </div>
                                <div class="mt-1 mx-auto text-center">
                                    <button type="submit" name="reset_password" class="btn rounded-0 col-9 btn-dark">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

</body>
</html>