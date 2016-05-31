<?php

require "core/init.php";

if (!User::isLoggedIn()) {
	Redirect::to("login.php");
}

if (isset($_GET["id"]) && (int) $_GET["id"] > 0) {
	$pm = PrivateMessage::get((int) $_GET["id"]);

	if ($pm) {
		$recipientId = $pm->recipient;
		$recipient = User::findById($recipientId)->username;

		if (Session::get("user") !== $recipient) {
			Redirect::to("index.php");
		}

		$sender = User::findById($pm->sender)->username;
		echo "exists";
	} else {
		echo "message with id: ", $_GET["id"], " does not exist";
	}
} else {
	Redirect::to("index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>View Message</title>
	<?php require "partials/stylesheets.html"; ?>
	<link rel="stylesheet" href="assets/css/lightbox.min.css">
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header">View message</h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="inbox.php">Inbox</a></li>
					<li class="active">View message</li>
				</ol>
				<hr>
			</div>
			<div class="col-sm-12">
				<?php if ($pm) : ?>
					<?php require "views/viewmessage-view.php"; ?>
				<?php else : ?>
					<h2>Nothing found</h2>
				<?php endif; ?>
				<!-- <h3>Subject: whaaaat</h3>
				<h5>From: username</h5>
				<h5>When: 31-05-2016 19:00</h5>
				<br>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima laborum obcaecati asperiores, saepe cumque numquam accusamus amet dicta reprehenderit repudiandae aperiam quod nihil, vitae facilis, dignissimos sed, aliquam? Atque rem, rerum perferendis. Consequatur doloribus, quae, excepturi atque voluptate perspiciatis! Perferendis, animi doloremque a ratione libero incidunt. Omnis nemo corrupti voluptate quam beatae natus eaque repellat dolor quasi temporibus minima eum aliquam tenetur, sapiente reiciendis. Adipisci, asperiores exercitationem natus cumque. Tempora aut, quod eius molestias. At esse reiciendis, necessitatibus, aperiam beatae, non id quidem aliquid provident nulla optio nihil incidunt veritatis atque, vero. Cupiditate rem, ea quos, dicta delectus aperiam odit.</p> -->
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>