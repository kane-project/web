<?php

	require_once("lib/Users.php");
	require_once("lib/Listings.php");
	require_once("lib/Messaging.php");

	session_start();
	if (!isset($_SESSION['landlord_id']))
		die(header("Location: /portal/login"));

	$listing = new Listing(fetch_listing_id($slug));

	$thread = new MessageThread;
	$thread->user_id = $_SESSION['landlord_id'];
	$thread->load_thread($listing->id);

	// if last message is for the user and unread, mark it as read
	if ($thread->last_message->receiver_id == $_SESSION['landlord_id'] && !$thread->last_message->is_read) {
		$thread->last_message->mark_read();
	}

	$page = "View Message";
	$user = new User($_SESSION['landlord_id']);
	
	if(isset($_POST['send_message']))
	{
		$msg = new Message;
		$msg->message_id = generate_uuid();
		$msg->sender_id = $_SESSION['landlord_id'];
		$msg->receiver_id = $_POST['tenant_id'];
		$msg->content = $_POST['message'];
		$msg->listing_id = fetch_listing_id($slug);
		$msg->timestamp = time();
		$msg->is_read = 0;

		if(send_message($msg))
		{
			header("Location: /portal/message/$slug");
		}
		else
		{
			throw new Exception("Failed to send message.");
		}
	}
	
	include("header.php");

?>
<body>

	<?php include("navbar.php"); ?>

	<main class="mb-5">

		<section class="container">
			<div class="row py-1">
				<div class="col-lg-12 py-2 mx-auto text-center">
					<h1>View Chat</h1>
					<a class="text-primary" href="/portal/messages">&larr; Back to Inbox</a>
				</div>
			</div>
		</section>

		<section class="container py-5">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-9 mx-auto">
					<div class="card p-3 rounded-0 shadow" id="chat1">
						<div class="card-body">

						<?php 
							
							$tenant = new User;

							foreach($thread->messages as $msg)
							{
								if($msg->sender_id == $_SESSION['landlord_id'])
								{
									echo <<<_END
									<div class="d-flex flex-row justify-content-end mb-4">
										<div class="p-2 me-3 border chat-incoming">
											<p class="small mb-0">$msg->content</p>
										</div>
										<img src="/uploads/profiles/$user->profile_photo" style="width: 45px; height: 100%;">
									</div>
									
_END;
								}
								else
								{
									$tenant = new User($msg->sender_id);
									echo <<<_END
									<div class="d-flex flex-row justify-content-start mb-4">
										<img src="/uploads/profiles/$tenant->profile_photo" alt="avatar 1" style="width: 45px; height: 100%;">
										<div class="p-2 ms-3 border chat-outgoing">
											<p class="small mb-0">$msg->content</p>
										</div>
									</div>
_END;
								}
							}

							?>

							<div class="form-outline">
								<form method="POST" action="/portal/message/<?php echo $slug; ?>">
									<div class="input-group">
										<input type="text" name="message" class="form-control rounded-0" placeholder="Type your message...">
										<button class="btn btn-dark rounded-0" name="send_message" type="submit">Send</button>
									</div>
									<input type="hidden" name="tenant_id" value="<?php echo $tenant->id; ?>">
								</form>
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