<?php

    require_once("lib/Users.php");
    require_once("lib/Listings.php");
    require_once("lib/Messaging.php");

    session_start();
    if(!isset($_SESSION['landlord_id']))
        die(header("Location: /portal/login"));

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
						
						<table class="table">
							<thead class="table-dark">
								<th>Listing</th>
								<th>Message</th>
								<th></th>
							</thead>
							<tbody>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Listing Title Shortened</a>&nbsp; <i class="fa fa-bell text-danger"></i></td>
									<td><b>In publishing and graphic design, Lorem ipsum is a placeholder text...</b></td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/portal/message/{threadid}">Open</a></td>
								</tr>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Another Listing Name</a></td>
									<td>The contents of a message that has already been opened...</td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/portal/message/{threadid}">Open</a></td>
								</tr>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Another Listing Name</a></td>
									<td>The contents of a message that has already been opened...</td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/portal/message/{threadid}">Open</a></td>
								</tr>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Another Listing Name</a></td>
									<td>The contents of a message that has already been opened...</td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/portal/message/{threadid}">Open</a></td>
								</tr>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Another Listing Name</a></td>
									<td>The contents of a message that has already been opened...</td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/portal/message/{threadid}">Open</a></td>
								</tr>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Another Listing Name</a></td>
									<td>The contents of a message that has already been opened...</td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/portal/message/{threadid}">Open</a></td>
								</tr>
							</tbody>
						</table>

						<div class="pagination">
							<div class="prev mx-3">
								<a href="javascript:void()" class="btn btn-sm rounded-0 btn-dark">&larr; Prev Page</a>
							</div>
							<div class="next mx-3">
								<a href="javascript:void()" class="btn btn-sm rounded-0 btn-dark">Next Page &rarr;</a>
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