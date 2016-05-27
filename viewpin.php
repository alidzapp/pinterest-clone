<?php
require "core/init.php";
if (isset($_POST["comment"], $_GET["id"]) && User::isLoggedIn()) {
	$pinId = (int) $_GET["id"];
	$body = $_POST["comment"];
	$validate = new Validate();
	$validate->check($_POST);
	if ($validate->passed()) {
		if (Pin::exists($pinId)) {
			$user = User::find(Session::get("user"));
			$comment = new Comment();
			$comment->create($user->id, $pinId, $body);
			Redirect::to("viewpin.php?id=" . $pinId);
		}
	}
}
require "models/viewpin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>View Pin</title>
	<?php require "partials/stylesheets.html"; ?>
	<link rel="stylesheet" href="assets/css/lightbox.min.css">
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header"><?php echo isset($pin) && !empty($pin) ? "Discuss" : "Nothing found"; ?></h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li class="active">View Pin</li>
				</ol>
				<hr>
			</div>

			<?php if (isset($pin) && !empty($pin)) : ?>
				<div class="col-sm-12">
					<div class="row">
						<?php require "views/singlepin.php"; ?>
						<div class="col-sm-12">
							<hr>
							<?php if (User::isLoggedIn()) : ?>
								<form action="" method="post">
									<div class="form-group">
										<label>Leave a comment</label>
										<?php if (isset($validate) && !empty($validate->errors())) echo $validate->error("comment"); ?>
										<textarea name="comment" rows="10" class="form-control" required></textarea>
									</div>
									<input type="submit" value="Send" class="btn btn-default">
								</form>
							<?php else : ?>
								<strong><a href="login.php">Log in</a> to leave a reply.</strong>
							<?php endif; ?>
							<hr>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<?php require "views/pin-comments.php"; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
	<script src="assets/js/like.js"></script>
	<script src="assets/js/jslightbox.min.js"></script>
</body>
</html>