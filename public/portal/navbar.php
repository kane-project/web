<!-- 

PORTAL
NAVBAR

-->
<nav class="navbar navbar-default navbar-trans navbar-expand-lg">
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
                        My Messages &nbsp;<span class="badge badge-sm p-2 rounded-1 bg-secondary">1</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        My Account
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item " href="portal/settings">Settings</a>
                        <a class="dropdown-item " href="portal/logout">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>