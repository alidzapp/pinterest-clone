<?php
require "core/init.php";
if (!User::isLoggedIn()) {
	Redirect::to("login.php");
}
if (isset($_POST["oldpassword"], $_POST["password"], $_POST["passwordconfirm"])) {
	$user = DB::getInstance()->query("SELECT password FROM users WHERE username=?", array(Session::get("user")));
	$results = $user->results()[0];
	if (password_verify(Input::get("oldpassword"), $results->password)) {
		$validate = new Validate();
		$validate->check(array(
			"password" => Input::get("password"),
			"passwordconfirm" => Input::get("passwordconfirm")
		));

		if ($validate->passed()) {
			DB::getInstance()->query("UPDATE users SET password=? WHERE username=?", array(
				password_hash(Input::get("password"), PASSWORD_DEFAULT),
				Session::get("user")
			));
			Session::flash("changepassword-success", "Password updated.");
			Redirect::to("changepassword.php");
		}

		Session::flash("changepassword-error", $validate->errors()["pass"]);
	} else {
		Session::flash("changepassword-error", "Incorrect password.");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Change Password</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header">Change Password</h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li><a href="settings.php">Settings</a></li>
					<li class="active">Change Password</li>
				</ol>
				<hr>
			</div>
			<div class="col-sm-12">
				<form action="changepassword.php" method="post">
					<div class="col-sm-6 clear-padding">
						<?php
							if (Session::exists("changepassword-error")) {
								printf('<div class="alert alert-danger"><strong>%s</strong></div>', Session::flash("changepassword-error"));
							} elseif (Session::exists("changepassword-success")) {
								printf('<div class="alert alert-success"><strong>%s</strong></div>', Session::flash("changepassword-success"));
							}
						?>
						<div class="form-group">
							<label>Current Password</label>
							<input type="password" name="oldpassword" class="form-control" required>
						</div>
						<div class="form-group">
							<label>New Password</label>
							<input type="password" name="password" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Confirm Password</label>
							<input type="password" name="passwordconfirm" class="form-control" required>
						</div>
						<input type="submit" value="Change" class="btn btn-default">
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>