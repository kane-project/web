<?php 

	require_once("lib/Users.php");
	session_start();

	if(!isset($_SESSION['uid']))
		die(header("Location: /account/login"));

	$user = new User($_SESSION['uid']);
	$page = "Account Dashboard";
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
							<h1 class="title-single">Welcome, <?php echo $user->first_name; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</section>
		
	</main>

	<?php include("footer.php"); ?>

</body>
</html>