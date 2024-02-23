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
							<h1 class="title-single">Purchases for Property Listers</h1>
                            <p>
                                You can always publish your listing for free, but optionally you can purchase sponsorhip tiers to boost your listing and 
                                support the KANE Project.
                            </p>
						</div>
					</div>                    
				</div>

                <div class="row py-5">
                    <div class="col-md-4">
                        <div style="height:300px;" class="card mb-4 p-1 bg-bronze border-0 text-light rounded-0 shadow">
                            <div class="card-body">
                                <h5 class="card-title">Bronze</h5>
                                <h6 class="card-subtitle mb-2">CA$2.99 One Time</h6>
                                <ul>
                                    <li>Boost your listing's visibility</li>
                                    <li>Rank higher in listing searches</li>
                                    <li>Attract more propsective tenants</li>
                                </ul>
                            </div>
                            <div class="card-footer border-0">
                                <a href="./portal/new" class="btn col-12 btn-light rounded-0">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="height:300px;" class="card mb-4 p-1 text-light border-0 bg-silver rounded-0 shadow">
                            <div class="card-body">
                                <h5 class="card-title">Silver &nbsp;<span class="badge badge-sm bg-light text-dark">Best Value</span></h5>
                                <h6 class="card-subtitle mb-2 text-light">CA$4.99 One Time</h6>
                                <ul>
                                    <li>Everything in Bronze tier included</li>
                                    <li><b>2x higher boost for listing visibility</b></li>
                                    <li>Unlock detailed listing statistics</li>
                                </ul>
                                
                            </div>
                            <div class="card-footer border-0">
                                <a href="./portal/new" class="btn col-12 btn-light rounded-0">Purchase</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="height:300px;" class="card mb-4 p-1 rounded-0 border-0 bg-gold text-light shadow">
                            <div class="card-body">
                                <h5 class="card-title">Gold &nbsp;<span class="badge bg-dark text-light badge-sm">Complete Package</span></h5>
                                <h6 class="card-subtitle mb-2">CA$9.99 One Time</h6>
                                <ul>
                                    <li><i>Everything in Bronze and Silver plus...</i></li>
                                    <li><b>Email promotion for your listing!</b></li>
                                    <li><b>3x higher Listing Visibility Boost</b></li>
                                </ul>
                                
                            </div>
                            <div class="card-footer border-0">
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