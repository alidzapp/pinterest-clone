<?php
require "core/init.php";
$pins = DB::getInstance()->query("SELECT p.id, p.title, p.img_url, u.username, COUNT(DISTINCT l.liked_by) AS likes, COUNT(DISTINCT r.reposted_by) AS reposts FROM pins p INNER JOIN users u ON p.author_id=u.id LEFT JOIN likes l on p.id=l.pin_id LEFT JOIN reposts r on p.id=r.pin_id GROUP BY p.id ORDER BY p.id DESC LIMIT 5");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pinterest</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<?php if (!User::isLoggedIn()) : ?>
					<h1 class="main-header">Welcome</h1>
					<p><a href="signup.php">Sign up</a> or <a href="login.php">login.</a></p>
				<?php else : ?>
					<h1 class="main-header">Welcome, <?php echo htmlspecialchars(Session::get("user")); ?></h1>
					<?php
					if (Session::exists("signup-success")) {
						printf('<div class="alert alert-success"><strong>%s</strong></div>', Session::flash("signup-success"));
					}
					?>
				<?php endif; ?>
				<hr>
			</div>
			<div class="col-sm-12">
				<h2>Recent Pins</h2>
				<?php if ($pins->count()) : ?>
				<div class="masonry-grid">
					<div class="masonry-grid-sizer"></div>
					<div class="row"><?php require "views/pin-list.php"; ?></div>
				</div>
				<?php else : ?>
				<h3>Nothing found.</h3>
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