<?php
require "core/init.php";
$pins = Pin::getAllPins();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Pins</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header">All Pins</h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li class="active">All Pins</li>
				</ol>
				<hr>
			</div>
			<div class="col-sm-12">
				<?php if ($pins->count()) : ?>
				<div class="masonry-grid">
					<div class="masonry-grid-sizer"></div>
					<div class="row"><?php require "views/pin-list.php"; ?></div>
				</div>
				<?php else : ?>
				<h2>Nothing found.</h2>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
	<script src="assets/js/imagesloaded.pkgd.min.js"></script>
	<script src="assets/js/masonry.pkgd.min.js"></script>
	<script src="assets/js/masonryinit.js"></script>
	<script src="assets/js/like.js"></script>
</body>
</html>