<?php
	require_once("lib/Users.php");
	require_once("lib/Listings.php");
	require_once("lib/Messaging.php");
	session_start();

	if(!isset($_SESSION['uid']))
		die(header("Location: /account/login"));

	$user = new User($_SESSION['uid']);
	$threads = fetch_all_threads($user->id, 0, fetch_threads_count($user->id));

	$page = "My Messages";
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
							<h1 class="title-single">My Messages</h1>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section>
			<div class="container">
				<div class="row">
					<div class="col-lg-12 mx-auto">
						
						<?php if(sizeof($threads)) { 
							if(isset($_GET['s'])) {
								echo "<div class='alert bg-success text-light rounded-0'><i class='fa fa-check-circle'></i>&nbsp; Message sent successfully.</div>";	
							}
						?>
						<table class="table">
							<thead class="table-dark">
								<th>Listing</th>
								<th>Message</th>
								<th></th>
							</thead>
							<tbody>
								
								<?php 

									foreach($threads as $thread)
									{
										$listingName = "Deleted Listing";
										$lastmsg = $thread->last_message->content;
										$listingId = 0;

										if(!$thread->is_listing_deleted()) {
											$listing = new Listing($thread->messages[0]->listing_id);
											$listingName = $listing->title;
											$listingId = $listing->slug;
										}

										echo <<<_END
										<tr>
											<td>$listingName</td>
											<td>$lastmsg</td>
											<td><a class="btn btn-sm rounded-0 btn-dark" href="/account/message/$listingId">Open Chat</a></td>
										</tr>
_END;
									}

								?>					

							</tbody>
						</table>

						<div class="pagination mt-5">
							<div class="prev mx-3">
								<a href="javascript:void()" class="btn btn-sm rounded-0 btn-dark">&larr; Prev Page</a>
							</div>
							<div class="next mx-3">
								<a href="javascript:void()" class="btn btn-sm rounded-0 btn-dark">Next Page &rarr;</a>
							</div>
						</div>
						<?php } else { ?>

						<div class="alert bg-primary text-light rounded-0">
							<i class="fa fa-info-circle"></i>&nbsp; You have no messages.
						</div>

						
						<?php } ?>
					</div>
				</div>
			</div>
		</section>

	</main>

	<div class="py-5"></div>
	<?php include("footer.php"); ?>

</body>
</html>