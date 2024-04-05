<?php 

    session_start();
    $page = "Safety Guide";
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
                            <h1 class="title-single">Your Safety Guide</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="safety-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="safety-title">Staying Safe in Your Rental Search</h2>
                        <p class="safety-text">
                            At KANE Project, your safety is our top priority. Whether you're searching for your next
                            home or listing your property, here are some guidelines to help you stay safe.
                        </p>
                        <h3>For Tenants</h3>
                        <ul class="safety-list">
                            <li><strong>Verify Listings:</strong> Be cautious of listings that seem too good to be true.
                                Verify property details and ownership before proceeding.</li>
                            <li><strong>Secure Payments:</strong> Never wire money or pay a security deposit before
                                meeting the landlord and signing a lease.</li>
                            <li><strong>Meet in Public:</strong> When viewing a property, always meet in public spaces
                                and consider bringing a friend.</li>
                        </ul>
                        <h3>For Landlords</h3>
                        <ul class="safety-list">
                            <li><strong>Screen Tenants:</strong> Conduct thorough background checks and verify the
                                identity of your potential tenants.</li>
                            <li><strong>Legal Agreements:</strong> Always use legal rental agreements. Ensure both
                                parties understand and agree to the terms.</li>
                            <li><strong>Property Showings:</strong> During showings, ensure your safety by scheduling
                                visits during daylight hours and informing someone of your whereabouts.</li>
                        </ul>
                        <h3>Online Safety Tips</h3>
                        <ul class="safety-list">
                            <li><strong>Protect Your Information:</strong> Be mindful of the personal information you
                                share online. Use secure platforms for communication.</li>
                            <li><strong>Phishing Scams:</strong> Be wary of emails or messages requesting personal
                                information or payments. KANE Project will never ask for your password or security
                                deposit directly.</li>
                            <li><strong>Report Suspicious Activity:</strong> If you encounter any suspicious activity or
                                listings on our platform, please report it to our support team immediately.</li>
                        </ul>
                        <p class="safety-text">
                            Following these guidelines can help create a safer environment for everyone on KANE Project.
                            For more information or assistance, please contact our support team.
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include("footer.php"); ?>

</body>

</html>