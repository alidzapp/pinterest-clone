<?php
require "core/init.php";
if (User::isLoggedIn()) {
	Redirect::to("index.php");
}
if (isset($_POST["username"], $_POST["password"])) {
	if (User::logIn(Input::get("username"), Input::get("password"))) {
		Session::set("user", Input::get("username"));
		Redirect::to("index.php");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header"><span class="glyphicon glyphicon-log-in"></span> Login</h1>
				<hr>
			</div>
			<div class="col-sm-12">
				<form action="login.php" method="post">
					<div class="col-sm-6 clear-padding">
						<?php
						if (Session::exists("login-error")) {
							printf('<div class="alert alert-danger"><strong>%s</strong></div>', Session::flash("login-error"));
						}
						?>
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" name="username" class="form-control" id="username" required value="<?php echo htmlspecialchars(Input::get("username")); ?>">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control" required>
						</div>
						<input type="submit" value="Log In" class="btn btn-default">
						<hr>
						<span class="help-block">Don't have an account? <a href="signup.php">Sign up</a> or go <a href="index.php">home</a>.</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>