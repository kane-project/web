<?php

	require_once("lib/Users.php");
	require_once("lib/Listings.php");
	require_once("lib/Messaging.php");

	session_start();
	if (!isset($_SESSION['landlord_id']))
		die(header("Location: /portal/login"));

	$page = "View Message";
	$user = new User($_SESSION['landlord_id']);
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

							<div class="d-flex flex-row justify-content-start mb-4">
								<img src="/uploads/profiles/default.png" alt="avatar 1" style="width: 45px; height: 100%;">
								<div class="p-2 ms-3 border chat-incoming">
									<p class="small mb-0">Hi is this property still available?</p>
								</div>
							</div>

							<div class="d-flex flex-row justify-content-end mb-4">
								<div class="p-2 me-3 border chat-outgoing">
									<p class="small mb-0">Yes.</p>
								</div>
								<img src="<?php echo "/uploads/profiles/".$user->profile_photo; ?>" alt="avatar 1" style="width: 45px; height: 100%;">
							</div>

							<div class="form-outline">
								<form>
									<div class="input-group">
										<input type="text" class="form-control rounded-0" placeholder="Type your message...">
										<button class="btn btn-dark rounded-0" type="submit">Send</button>
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

</body>
</html>