<?php
require "core/init.php";
if (!User::isLoggedIn()) {
	Redirect::to("login.php");
}
$user = DB::getInstance()->query(sprintf("SELECT * FROM users WHERE username='%s'", Session::get("user")))->results()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Settings</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header">Settings</h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li class="active">Settings</li>
				</ol>
				<hr>
			</div>
			<div class="col-sm-12">
				<h2>User information</h2>
				<div class="col-sm-6 clear-padding user-information">
					<hr>
					<div class="form-group">
						<label>First name:</label>
						<input type="text" name="firstname" disabled class="form-control" value="<?php echo htmlspecialchars($user->first_name); ?>">
					</div>
					<div class="form-group">
						<label>Last name:</label>
						<input type="text" name="lastname" disabled class="form-control" value="<?php echo htmlspecialchars($user->last_name); ?>">
					</div>
					<div class="form-group">
						<label>Username:</label>
						<input type="text" name="username" disabled class="form-control" value="<?php echo htmlspecialchars($user->username); ?>">
					</div>
					<div class="form-group">
						<label>Email:</label>
						<input type="email" name="email" disabled class="form-control" value="<?php echo htmlspecialchars($user->email); ?>">
					</div>
					<span class="help-block"><a href="changepassword.php">Change password</a> / <a href="editprofile.php">Edit profile</a></span>
				</div>
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>