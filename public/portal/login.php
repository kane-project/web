<?php

$page = "Portal Login";
include("header.php");

?>

<body>

	<main id="main">

		<div class="container py-5">
			<div class="row py-5 justify-content-center">
				<div class="col-md-6 py-3 mx-auto">
					<div class="card p-3 rounded-0 shadow">
						<div class="card-body">
							<h5 class="card-title text-center">Portal Login</h5>
							<form method="POST" action="">
								<div class="mb-3">
									<label for="email" class="form-label">Email Address</label>
									<input type="email" required class="form-control rounded-0" id="email" placeholder="Enter email">
								</div>
								<div class="mb-3">
									<label for="password" class="form-label">Password</label>
									<input type="password" required class="form-control rounded-0" id="password" placeholder="Enter password">
								</div>
								<div class="mb-3 text-center">
									<button type="submit" class="btn col-6 rounded-0 btn-primary">Login</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>


	</main>

	<?php include("footer.php"); ?>

</body>
</html>