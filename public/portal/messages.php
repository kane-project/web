<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");
    require_once("lib/Messaging.php");

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

	$threads = fetch_all_threads($_SESSION['landlord_id'], 0, fetch_threads_count($_SESSION['landlord_id']));

    $page = "Messages";
    $user = new User($_SESSION['landlord_id']);
    include("header.php");

?>
<body>

    <?php include("navbar.php"); ?>

    <main class="mb-5">
        
        <section class="container">
            <div class="row py-1">
                <div class="col-lg-12 py-2 mx-auto text-center">
                    <h1>Inbox</h1>
                </div>
            </div>
        </section>

        <section class="py-3">
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
										$lastmsg = substr($thread->last_message->content, 0, 50);
										
										if (strlen($thread->last_message->content) > 50) {
											$lastmsg .= '...';
										}

										$listingId = 0;

										$notif = "";

										if($thread->last_message->receiver_id == $user->id && !$thread->last_message->is_read) {
											$notif = "<span class='badge bg-danger rounded-0'>New</span>";
										}

										

										if(!$thread->is_listing_deleted()) {
											$listing = new Listing($thread->messages[0]->listing_id);
											$listingName = $listing->title;
											$listingId = $listing->slug;
										}

										echo <<<_END
										<tr>
											<td>$listingName</td>
											<td>$notif &nbsp; $lastmsg</td>
											<td><a class="btn btn-sm rounded-0 btn-dark" href="/portal/message/$listingId">Open Chat</a></td>
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

    <?php include("footer.php"); ?>

</body>
</html>