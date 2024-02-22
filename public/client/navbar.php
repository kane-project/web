<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a class="navbar-brand text-brand" href=""><span class="color-b">KANE</span>Project</a>
        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == "Home") echo "active"; ?>" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == "Listings") echo "active"; ?>" href="listings">View Listings</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Your Account
                    </a>
                    <div class="dropdown-menu">
                        <?php 
                            if(isset($_SESSION['uid'])) {

                                require_once("lib/Messaging.php");

                                $notifs = get_notif_count($_SESSION['uid']);
                                if($notifs)
                                    $notifs = '&nbsp;<span class="badge badge-sm bg-danger"><i class="fa fa-bell"></i> &nbsp;'.$notifs.'</span>';
                                else 
                                    $notifs = '';

                                echo '
                                    <a class="dropdown-item" href="/account/messages">Inbox '.$notifs.'</a>
                                    <a class="dropdown-item" href="/account">Settings</a>
                                    <a class="dropdown-item" href="/account/logout">Logout</a>
                                ';
                            }
                            
                            else {
                                echo '
                                    <a class="dropdown-item" href="/account/login">Login</a>
                                    <a class="dropdown-item" href="/account/register">Register</a>
                                ';
                            }
                        ?> 
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == "Pricing") echo "active"; ?>" href="pricing">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == "About") echo "active"; ?>" href="about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == "Contact") echo "active"; ?>" href="contact">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="btn rounded-0 btn-dark" target="_blank" href="portal/">List Your Property</a>
                </li>
            </ul>
        </div>
    </div>
</nav>