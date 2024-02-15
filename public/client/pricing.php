<?php 

    session_start();
    $page = "Pricing";
    include("header.php"); 

?>

<body>

	<?php include("navbar.php"); ?>

	<main id="main">

		<section class="intro-single">
			<div class="container">

                <div class="row py-3">
					<div class="col-md-12 col-lg-12">
						<div class="title-single-box">
							<h1 class="title-single">For Prospective Tenants</h1>
                            <p>
                                You can always create an account and use our platform for free, but optionally you can purchase tenant verification badges to
                                build your credibility and gain more visibility.
                                This badge will be displayed on your profile and will be visible to landlords and property managers.
                            </p>
						</div>
					</div>                    
				</div>

                <div class="row py-5">
                    <div class="col-md-6">
                        <div class="card mb-4 p-1 rounded-0 shadow">
                            <div class="card-body">
                                <h5 class="card-title">ID Verification &nbsp;<span class="badge badge-sm bg-dark text-light">Beta</span></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><del>CA$4.99</del> CA$3.49 One Time</h6>
                                <ul class="list-unstyled">
                                    <li>Securely verify your photo ID</li>
                                    <li>Gain more credibility and trust</li>
                                    <li>Get a Verified badge</li>
                                </ul>
                                <a href="./account/badges" class="btn col-12 btn-dark rounded-0">Purchase</a>
                            </div>
                        </div>
                    </div>
                </div>


				<div class="row py-3">
					<div class="col-md-12 col-lg-12">
						<div class="title-single-box">
							<h1 class="title-single">For Property Owners</h1>
                            <p>
                                You can always publish your listing for free, but optionally you can purchase sponsorhip tiers to boost your listing and 
                                support the KANE Project.
                            </p>
						</div>
					</div>                    
				</div>
                <div class="row py-5">
                    <div class="col-md-4">
                        <div class="card mb-4 p-1 bg-bronze border-0 text-light rounded-0 shadow">
                            <div class="card-body">
                                <h5 class="card-title">Bronze</h5>
                                <h6 class="card-subtitle mb-2">CA$2.99 One Time</h6>
                                <ul>
                                    <li>Boost your listing's visibility</li>
                                </ul>
                                <a href="./portal/new" class="btn col-12 btn-dark rounded-0">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 p-1 text-light border-0 bg-silver rounded-0 shadow">
                            <div class="card-body">
                                <h5 class="card-title">Silver &nbsp;<span class="badge badge-sm bg-light text-dark">Best Value</span></h5>
                                <h6 class="card-subtitle mb-2 text-light">CA$4.99 One Time</h6>
                                <ul>
                                    <li>Higher boost for listing visibility</li>
                                    <li>Unlock detailed listing reach statistics</li>
                                </ul>
                                <a href="./portal/new" class="btn col-12 btn-light rounded-0">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 p-1 rounded-0 border-0 bg-gold text-light shadow">
                            <div class="card-body">
                                <h5 class="card-title">Gold &nbsp;<span class="badge bg-dark text-light badge-sm">Best Visibility</span></h5>
                                <h6 class="card-subtitle mb-2">CA$9.99 One Time</h6>
                                <ul>
                                    <li>Best possible visibility for your listing</li>
                                    <li>Everything in Bronze and Silver tiers included</li>
                                    <li>Access direct email marketing for your listings</li>
                                    <li>Priority Customer Support</li>
                                </ul>
                                <a href="./portal/new" class="btn col-12 btn-dark rounded-0">Purchase</a>
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