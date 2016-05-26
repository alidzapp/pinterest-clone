<?php
require "core/init.php";
$pagination = new Pagination();
$pins = Pin::all($pagination->start, $pagination->limit)->results();
$pagination->totalRows();
$pagination->pageOffset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>All Pins</title>
	<?php require "partials/stylesheets.html"; ?>
	<link rel="stylesheet" href="assets/css/lightbox.min.css">
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
				<?php if (!empty($pins)) : ?>
					<div class="masonry-grid">
						<div class="masonry-grid-sizer"></div>
						<div class="row"><?php require "views/pin-list.php"; ?></div>
					</div>
					<hr>
					<?php require "views/pagination-limits.php"; ?>
					<?php require "views/pagination-view.php"; ?>
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
	<script src="assets/js/jslightbox.min.js"></script>
</body>
</html>