<?php 
	require_once("lib/Users.php");
	require_once("lib/Listings.php");
	require_once("lib/Messaging.php");	
	session_start();

	if(!isset($_SESSION['uid']))
		die(header("Location: /account/login"));

	
	$listing = new Listing(fetch_listing_id($slug));
	$thread = new MessageThread;
	$thread->user_id = $_SESSION['uid'];
	$thread->load_thread($listing->id);

	// if last message is for the user and unread, mark it as read
	if ($thread->last_message->receiver_id == $_SESSION['uid'] && !$thread->last_message->is_read) {
		$thread->last_message->mark_read();
	}

	if(isset($_POST['send_message']))
	{
		$msg = new Message;
		$msg->message_id = generate_uuid();
		$msg->sender_id = $_SESSION['uid'];
		$msg->receiver_id = $listing->userid;
		$msg->content = $_POST['message'];
		$msg->listing_id = fetch_listing_id($slug);
		$msg->timestamp = time();
		$msg->is_read = 0;

		if(send_message($msg))
		{
			header("Location: /account/message/$slug");
		}
		else
		{
			throw new Exception("Failed to send message.");
		}
	}

	$user = new User($_SESSION['uid']);
	$page = "View Message";
	include("header.php"); 
?>
<head><link rel="stylesheet" href="assets/css/portal.css"></head>
<body>

	<?php include("navbar.php"); ?>

	<main id="main">

		<section class="intro-single">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12">
						<div class="title-single-box">
							<h1 class="title-single">View Chat</h1>
							<a class="text-primary" href="/account/messages">&larr; Back to Inbox</a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="container py-5">
			<div class="row d-flex justify-content-center">
				<div class="col-lg-9 mx-auto">
					<div class="card p-4 rounded-0 shadow" id="chat1">
						<div class="card-body" id="chat-container" style="max-height: 500px; overflow-y: auto;">
							
							<?php 

								foreach($thread->messages as $msg)
								{
									if($msg->sender_id == $_SESSION['uid'])
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
										$landlord = new User($msg->sender_id);
										echo <<<_END
										<div class="d-flex flex-row justify-content-start mb-4">
											<img src="/uploads/profiles/$landlord->profile_photo" alt="avatar 1" style="width: 45px; height: 100%;">
											<div class="p-2 ms-3 border chat-outgoing">
												<p class="small mb-0">$msg->content</p>
											</div>
										</div>
_END;
									}
								}

							?>	

							<div class="form-outline">
								<form method="POST" action="/account/message/<?php echo $slug; ?>">
									<div class="input-group">
										<input type="text" name="message" class="form-control rounded-0" placeholder="Type your message...">
										<button name="send_message" class="btn btn-dark rounded-0" type="submit">Send</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</section>

	</main>

	<?php include("footer.php"); ?>

	<script>

    // Function to scroll to the bottom of the chat container
    function scrollToBottom() {
        var chatContainer = document.getElementById('chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Scroll to bottom when the page loads
    window.onload = function() {
        scrollToBottom();
    };

    // Scroll to bottom when a new message is added (you can call this function after adding a new message)
    function onNewMessageAdded() {
        scrollToBottom();
    }

	</script>


</body>
</html>