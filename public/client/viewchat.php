<?php 

	session_start();
	$page = "View Message";
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
							<h1 class="title-single">{MessageView}</h1>
						</div>
					</div>
				</div>
			</div>
		</section>

		
		
	</main>

	<?php include("footer.php"); ?>

</body>
</html>