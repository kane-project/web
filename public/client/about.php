<?php 

    session_start();

    $page = "About";
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
                            <h1 class="title-single">Empowering New Communities & Individuals</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-about">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 position-relative">
                        <div class="about-img-box">
                            <img src="assets/img/slide-about-1.jpg" alt="" class="img-fluid">
                        </div>
                        <div class="sinse-box">
                            <h3 class="sinse-title text-light">
                                Introducing
                                <br> The KANE Project
                            </h3>
                        </div>
                    </div>
                    <div class="col-md-12 section-t8 position-relative">
                        <div class="row">
                            <div class="col-md-6 col-lg-5">
                                <img src="assets/img/about-2.jpg" alt="" class="img-fluid">
                            </div>
                            <div class="col-md-6 col-lg-5 section-md-t3">
                                <div class="title-box-d">
                                    <h3 class="title-d">Our Mission</h3>
                                </div>
                                <p class="color-text-a">
                                    Our mission is simple: to simplify the rental process for newcomers to Canada,
                                    making it easier to find a place that feels like home. We aim to provide a
                                    comprehensive, easy-to-navigate platform that not only helps tenants find their
                                    ideal home but also enables landlords to connect with potential tenants more
                                    effectively.
                                </p>
                                <p class="color-text-a">
                                    KANE Project is built on cutting-edge technology to ensure a smooth, efficient
                                    experience for all users. Our platform utilizes a responsive design, ensuring it's
                                    accessible on any device, from desktops to smartphones. Behind the scenes, we
                                    leverage the power of cloud computing for scalability, a robust database management
                                    system for secure data storage, and advanced security measures to protect our users'
                                    information.
                                </p>
                                <p class="color-text-a">
                                    Thank you for choosing KANE Project. Together, let's make your journey to finding
                                    the perfect home in Canada a little easier.
                                </p>
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