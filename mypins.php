<?php
require "core/init.php";
if (!User::isLoggedIn()) {
	Redirect::to("login.php");
}

$pins = Pin::getByUser(Session::get("user"));
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Pins</title>
	<?php require "partials/stylesheets.html"; ?>
	<link rel="stylesheet" href="assets/css/lightbox.min.css">
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header">My Pins</h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li class="active">My Pins</li>
				</ol>
				<hr>
			</div>
			<div class="col-sm-12">
				<?php
				if (Session::exists("pinremove-success")) {
					printf('<div class="alert alert-success"><strong>%s</strong></div>', Session::flash("pinremove-success"));
				}
				?>
				<?php if ($pins->count()) : ?>
				<div class="masonry-grid">
					<div class="masonry-grid-sizer"></div>
					<div class="row">
						<?php require "views/pin-list.php"; ?>
					</div>
				</div>
				<?php else : ?>
				<p>You have no pins! <a href="newpin.php">Click </a>to add one!</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
	<script src="assets/js/imagesloaded.pkgd.min.js"></script>
	<script src="assets/js/masonry.pkgd.min.js"></script>
	<script src="assets/js/masonryinit.js"></script>
	<script src="assets/js/like.js"></script>
	<script src="assets/js/jslightbox.min.js"></script>
</body>
</html>