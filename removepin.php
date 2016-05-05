<?php
require "core/init.php";
if (!User::isLoggedIn() || !isset($_GET["id"]) || !is_numeric(Input::get("id"))) {
	Redirect::to("index.php");
}

// $sql = sprintf("SELECT * from pins INNER JOIN users on pins.author_id=users.id WHERE pins.id=%d", Input::get("id"));
$pin = Pin::getPin(Input::get("id"));
if ($pin->results()[0]->username !== Session::get("user")) {
	die("Error 403. Access denied.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Remove Pin</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header"><span class="glyphicon glyphicon-alert"></span> <?php printf("Remove pin '%s'?", htmlspecialchars($pin->results()[0]->title)) ?></h1>
				<hr>
			</div>
			<div class="col-sm-12">
				<form action="terminatepin.php" method="post">
					<h4>Are you sure you want to do this? This action cannot be undone.</h4>
					<input type="hidden" name="pinid" value="<?php echo Input::get("id"); ?>">
					<input type="submit" class="btn btn-danger" value="Remove"><a href="mypins.php" class="btn btn-default">Go back</a>
				</form>
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>