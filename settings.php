<?php
require "core/init.php";
if (!User::isLoggedIn()) {
	Redirect::to("login.php");
}
// $user = DB::getInstance()->query("SELECT * FROM users WHERE username=?", array(Session::get("user")))->results()[0];
$user = DB::getInstance()->query("SELECT u.first_name, u.last_name, u.email, u.username, DATE_FORMAT(u.date_added, '%D %b %Y') AS join_date, COUNT(DISTINCT p.id) AS pin_amount, COUNT(DISTINCT l.id) AS likes_amount, COUNT(DISTINCT r.id) AS reposts_amount FROM `users` u LEFT JOIN pins p ON u.id=p.author_id LEFT JOIN likes l ON u.id=l.liked_by LEFT JOIN reposts r on u.id=r.reposted_by WHERE u.username=? GROUP BY u.username", array(Session::get("user")))->results()[0];
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
			<div class="col-sm-6">
				<h2>User information</h2>
				<div class="col-md-12 clear-padding user-information">
					<hr>
					<?php require "views/user-information.php"; ?>
					<span class="help-block"><a href="changepassword.php">Change password</a> / <a href="editprofile.php">Edit profile</a></span>
					<!-- <div class="form-group">
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
					</div> -->
				</div>
			</div>
			<div class="col-sm-6">
				<h2>Statistics</h2>
				<div class="col-sm-12 clear-padding">
					<hr>
					<ul class="remove-bullets clear-padding">
						<li><span class="glyphicon glyphicon-pushpin"></span> <?php echo $user->pin_amount, " pins posted."; ?></li>
						<li><span class="glyphicon glyphicon-star"></span> <?php echo $user->likes_amount, " pins liked."; ?></li>
						<li><span class="glyphicon glyphicon-repeat"></span> <?php echo $user->reposts_amount, " pins reposted."; ?></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>