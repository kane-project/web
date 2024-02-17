<?php
	session_start();
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
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/account/message/{threadid}">Open</a></td>
								</tr>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Another Listing Name</a></td>
									<td>The contents of a message that has already been opened...</td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/account/message/{threadid}">Open</a></td>
								</tr>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Another Listing Name</a></td>
									<td>The contents of a message that has already been opened...</td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/account/message/{threadid}">Open</a></td>
								</tr>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Another Listing Name</a></td>
									<td>The contents of a message that has already been opened...</td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/account/message/{threadid}">Open</a></td>
								</tr>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Another Listing Name</a></td>
									<td>The contents of a message that has already been opened...</td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/account/message/{threadid}">Open</a></td>
								</tr>
								<tr>
									<td><a class="text-primary" href="javascript:void()">Another Listing Name</a></td>
									<td>The contents of a message that has already been opened...</td>
									<td><a class="btn btn-sm rounded-0 btn-dark" href="/account/message/{threadid}">Open</a></td>
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

	<div class="py-5"></div>
	<?php include("footer.php"); ?>

</body>
</html>