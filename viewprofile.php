<?php
require "core/init.php";
if (isset($_GET["user"]) && mb_strlen($_GET["user"]) > 0) {
	$name = urldecode($_GET["user"]);
	$user = DB::getInstance()->query("
		SELECT username, first_name, last_name, email, username, DATE_FORMAT(date_added, '%D %b %Y') AS join_date
		FROM users
		WHERE username=?
		",
		array($name)
	);
	if ($user->count()) {
		$user = $user->results()[0];
		$username = $user->username;
		$pagination = new Pagination();
		$rows = User::pins(
			$username,
			$pagination->start,
			$pagination->limit
		);
		$pins = $rows->results();
		$pagination->totalRows();
		$pagination->pageOffset();
	}
} else {
	Redirect::to("index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>View Profile</title>
	<?php require "partials/stylesheets.html"; ?>
	<link rel="stylesheet" href="assets/css/lightbox.min.css">
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header"><?php echo isset($username) ? htmlspecialchars($username) . "'s profile" : "No user found."; ?></h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li class="active">View Profile</li>
				</ol>
				<!-- <hr> -->
			</div>
			<?php if (isset($username)) : ?>
				<div class="col-sm-12">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#feed">Feed</a></li>
						<li><a data-toggle="tab" href="#profile">Profile</a></li>
					</ul>
					<div class="tab-content">
						<div id="feed" class="tab-pane fade in active">
							<?php if (isset($pins) && !empty($pins)) : ?>
								<div class="masonry-grid">
									<div class="masonry-grid-sizer"></div>
									<div class="row"><?php require "views/pin-list.php"; ?></div>
								</div>
								<hr>
								<?php require "views/pagination-limits.php"; ?>
								<?php require "views/pagination-view.php"; ?>
							<?php elseif (isset($pins) && empty($pins)) : ?>
								<h2>This user has no pins yet.</h2>
							<?php endif; ?>
						</div>
						<div id="profile" class="tab-pane fade">
							<br>
							<?php require "views/user-information.php"; ?>
						</div>
					</div>
				</div>
			<?php endif; ?>
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