<?php
require "core/init.php";
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
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>