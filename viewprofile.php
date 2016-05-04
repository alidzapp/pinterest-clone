<?php
require "core/init.php";
if (isset($_GET["user"])) {
	$name = urldecode($_GET["user"]);
	$user = DB::getInstance()->query("SELECT username FROM users WHERE username=?", array($name));
	if ($user->count()) {
		$username = $user->results()[0]->username;
		$pins = Pin::getByUser($username);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>View Profile</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header"><?php echo isset($username) ? htmlspecialchars($username) . "'s feed" : "No user found."; ?></h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li class="active">View Profile</li>
				</ol>
				<hr>
			</div>
			<div class="col-sm-12">
				<?php if (isset($pins) && $pins->count()) : ?>
				<div class="masonry-grid">
					<div class="masonry-grid-sizer"></div>
					<div class="row"><?php require "views/pin-list.php"; ?></div>
				</div>
				<?php elseif (isset($pins) && !$pins->count()) : ?>
					<h2>This user has no pins yet.</h2>
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