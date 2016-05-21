<?php
require "core/init.php";
if (!User::isLoggedIn()) {
	Redirect::to("login.php");
}
if (isset($_POST["pinname"], $_POST["pinurl"])) {
	$validate = new Validate();
	$validate->check($_POST);

	if ($validate->passed()) {
		$pin = new Pin();
		$pin->create(Session::get("user"), Input::get("pinname"), Input::get("pinurl"));
		Session::flash("newpin-success", sprintf("New pin '%s' created!", htmlspecialchars(Input::get("pinname"))));
		Redirect::to("newpin.php");
	} else {
		Session::flash("newpin-error", "Failed to create new pin.");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>New Pin</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header">New Pin</h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li class="active">New pin</li>
				</ol>
				<hr>
			</div>
			<div class="col-sm-12">
			<?php
				if (Session::exists("newpin-error")) {
					printf('<div class="alert alert-danger"><strong>%s</strong></div>', Session::flash("newpin-error"));
				} elseif (Session::exists("newpin-success")) {
					printf('<div class="alert alert-success"><strong>%s</strong></div>', Session::flash("newpin-success"));
				}
			?>
				<form action="newpin.php" method="post">
					<div class="col-sm-6 clear-padding">
						<div class="form-group <?php if (Input::exists() && $validate->error("pinname")) echo " has-error"; ?>">
							<label for="pinname">Pin name:</label>
							<?php if (Input::exists()) echo $validate->error("pinname"); ?>
							<input type="text" name="pinname" id="pinname" class="form-control" required value="<?php echo htmlspecialchars(Input::get("pinname")); ?>">
						</div>
						<div class="form-group <?php if (Input::exists() && $validate->error("pinurl")) echo " has-error"; ?>">
							<label for="pinurl">Image url:</label>
							<?php if (Input::exists()) echo $validate->error("pinurl"); ?>
							<input type="text" name="pinurl" id="pinurl" class="form-control" required value="<?php echo htmlspecialchars(Input::get("pinurl")); ?>">
						</div>
						<input type="submit" value="Add" class="btn btn-default">
						<hr>
						<span class="help-block"><a href="mypins.php">My Pins</a>.</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>