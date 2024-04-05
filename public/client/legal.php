<?php 

	session_start();
	
	if($slug == 'terms') $page = "Terms of Service";
	if($slug == 'privacy') $page = "Privacy Policy";

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
							<h1 class="title-single"><?php echo $page; ?></h1>
							<?php 
								if($page == "Terms of Service") 
								{
									echo <<<_END
_END;
								} 
								
								else if($page == "Privacy Policy") 
								{
									echo <<<_END
_END;
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</section>
			
	</main>

	<?php include("footer.php"); ?>

</body>
</html>