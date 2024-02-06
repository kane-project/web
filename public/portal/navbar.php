<!-- 

PORTAL
NAVBAR

-->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg" style="box-shadow: none;">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault" aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == "Dashboard") echo "active"; ?>" href="portal">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == "New Listing") echo "active"; ?>" href="portal/new">Add New Listing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == "My Listings") echo "active"; ?>" href="portal/listings">My Listings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if ($page == "My Messages") echo "active"; ?>" href="portal/messages">
                        My Messages &nbsp;<i class="fa fa-bell text-danger"></i><sup><span class="badge bg-danger">4</span></sup>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <?php 
                        if($user->profile_photo == "")
                            $user->profile_photo = "default.png";
                    ?>
                    <a class="nav-link dropdown-toggle p-1" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="profile-pic"><img class="img-fluid rounded-circle" src="/uploads/profiles/<?php echo $user->profile_photo ?>"></span>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="portal/settings">Settings</a>
                        <a class="dropdown-item" href="portal/logout">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>