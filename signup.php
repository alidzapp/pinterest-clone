<?php
require "core/init.php";

if (User::isLoggedIn()) {
	Redirect::to("index.php");
}

if (isset($_POST["username"], $_POST["email"], $_POST["password"], $_POST["passwordconfirm"])) {
	$validate = new Validate();
	$validate->check($_POST);

	if ($validate->passed()) {
		$user = new User();
		$user->create(
			Input::get("firstname"),
			Input::get("lastname"),
			Input::get("username"),
			Input::get("email"),
			Input::get("password")
		);
		Session::set("user", Input::get("username"));
		Session::flash("signup-success", "You have signed up.");
		Redirect::to("index.php");
	} else {
		Session::flash("signup-error", "Failed to sign up.");
	}
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sign Up</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header"><span class="glyphicon glyphicon-share"></span> Sign Up</h1>
				<hr>
			</div>
			<form action="signup.php" method="post">
				<div class="col-sm-6">
					<?php
					if (Session::exists("signup-error")) {
						printf('<div class="alert alert-danger"><strong>%s</strong></div>', Session::flash("signup-error"));
					}
					?>
					<div class="form-group <?php if (Input::exists() && $validate->error("firstname")) echo " has-error"; ?>">
						<label for="signup-firstname">First Name</label>
						<?php if (Input::exists()) echo $validate->error("firstname"); ?>
						<input type="text" name="firstname" id="signup-firstname" placeholder="Optional" class="form-control" value="<?php echo htmlspecialchars(Input::get("firstname")); ?>">
					</div>
					<div class="form-group <?php if (Input::exists() && $validate->error("lastname")) echo " has-error"; ?>">
						<label for="signup-lastname">Last Name</label>
						<?php if (Input::exists()) echo $validate->error("lastname"); ?>
						<input type="text" name="lastname" id="signup-lastname" placeholder="Optional" class="form-control" value="<?php echo htmlspecialchars(Input::get("lastname")); ?>">
					</div>
					<div class="form-group <?php if (Input::exists() && $validate->error("username")) echo " has-error"; ?>">
						<label for="signup-username">Username<span class="red-star">*</span></label>
						<?php if (Input::exists()) echo $validate->error("username"); ?>
						<input type="text" name="username" id="signup-username" placeholder="Required" class="form-control" required value="<?php echo htmlspecialchars(Input::get("username")); ?>">
					</div>
					<div class="form-group <?php if (Input::exists() && $validate->error("email")) echo " has-error"; ?>">
						<label for="signup-email">Email<span class="red-star">*</span></label>
						<?php if (Input::exists()) echo $validate->error("email"); ?>
						<input type="email" name="email" id="signup-email" placeholder="Required" class="form-control" required value="<?php echo htmlspecialchars(Input::get("email")); ?>">
					</div>
					<div class="form-group <?php if (Input::exists() && $validate->error("pass")) echo " has-error"; ?>">
						<label for="signup-password">Password<span class="red-star">*</span></label>
						<?php if (Input::exists()) echo $validate->error("pass"); ?>
						<input type="password" name="password" id="signup-password" placeholder="Required" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="signup-password-confirm">Confirm Password<span class="red-star">*</span></label>
						<input type="password" name="passwordconfirm" id="signup-password-confirm" placeholder="Required" class="form-control" required>
					</div>
					<input type="submit" value="Register" class="btn btn-default">
					<hr>
					<span class="help-block">Already have an account? <a href="login.php">Log in</a> or go <a href="index.php">home</a>.</span>
				</div>
			</form>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>