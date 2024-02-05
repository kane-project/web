<?php $page = "Pricing";
include("header.php") ?>

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
                                <h6 class="card-subtitle mb-2 text-muted"><del>$4.99</del> $3.49 One Time</h6>
                                <ul class="list-unstyled">
                                    <li>Securely verify your Photo ID</li>
                                    <li>Gain more credibility and trust</li>
                                    <li>Get a Verified badge</li>
                                </ul>
                                <a href="./account/badges" class="btn col-12 btn-dark rounded-0">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-4 p-1 text-light bg-primary rounded-0 shadow">
                            <div class="card-body">
                                <h5 class="card-title">Credit Check &nbsp;<span class="badge badge-sm bg-light text-dark">Beta</span></h5>
                                <h6 class="card-subtitle mb-2 text-light"><del>$9.99</del> $6.99 One Time</h6>
                                <ul class="list-unstyled">
                                    <li>Easy and secure credit checks</li>
                                    <li>Get a Credit Check badge</li>   
                                    <li>Gain more credibility and trust</li>                                        
                                </ul>
                                <a href="./account/badges" class="btn col-12 btn-light rounded-0">Purchase</a>
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
                        <div class="card mb-4 p-1 rounded-0 shadow">
                            <div class="card-body">
                                <h5 class="card-title">Bronze</h5>
                                <h6 class="card-subtitle mb-2 text-muted">$2.99 One Time</h6>
                                <ul class="list-unstyled">
                                    <li>Increases your listing visibility</li>
                                </ul>
                                <a href="./portal/new" class="btn col-12 btn-dark rounded-0">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 p-1 text-light bg-secondary rounded-0 shadow">
                            <div class="card-body">
                                <h5 class="card-title">Silver &nbsp;<span class="badge badge-sm bg-light text-dark">Best Plan!</span></h5>
                                <h6 class="card-subtitle mb-2 text-light">$4.99 One Time</h6>
                                <ul class="list-unstyled">
                                    <li>Even better reach and engagement for your listing</li>
                                    <li>Unlock detailed statistics about your listing's visitors</li>
                                </ul>
                                <a href="./portal/new" class="btn col-12 btn-light rounded-0">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card mb-4 p-1 rounded-0 shadow bg-warning text-light">
                            <div class="card-body">
                                <h5 class="card-title">Gold &nbsp;<span class="badge bg-dark text-light badge-sm">Best Visibility!</span></h5>
                                <h6 class="card-subtitle mb-2">$9.99 One Time</h6>
                                <ul class="list-unstyled">
                                    <li>Best Visibility</li>
                                    <li>Everything in Bronze and Silver included</li>
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