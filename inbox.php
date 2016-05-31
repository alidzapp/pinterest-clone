<?php
require "core/init.php";

if (!User::isLoggedIn()) {
	Redirect::to("login.php");
}

require "models/inbox-model.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Inbox</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header">Inbox</h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li class="active">Inbox</li>
				</ol>
				<hr>
				<?php if (Session::exists("sendPm-success")) : ?>
					<div class="alert alert-success">
						<strong><?php echo htmlspecialchars(Session::flash("sendPm-success")); ?></strong>
					</div>
				<?php elseif (Session::exists("sendPm-error")) : ?>
					<div class="alert alert-danger">
						<strong><?php echo htmlspecialchars(Session::flash("sendPm-error")); ?></strong>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-sm-12">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#inbox">Inbox</a></li>
					<li><a data-toggle="tab" href="#new-mail">New</a></li>
				</ul>
				<div class="tab-content">
					<div id="inbox" class="tab-pane fade in active">
						<br>
						<table class="table table-striped table-bordered">
							<tr>
								<th>Subject</th>
								<th>From</th>
								<th>Date</th>
								<th>Delete</th>
							</tr>
							<?php require "views/inbox-view.php"; ?>
						</table>
					</div>

					<div id="new-mail" class="tab-pane fade">
						<br>
						<form action="createprivatemessage.php" method="post">
							<div class="form-group">
								<label>Recipient</label>
								<input type="text" name="recipient" class="form-control" required placeholder="Username..">
							</div>
							<div class="form-group">
								<label>Subject</label>
								<input type="text" name="subject" class="form-control" required placeholder="Subject..">
							</div>
							<div class="form-group">
								<label>Message</label>
								<textarea name="messageBody" rows="10" class="form-control" required placeholder="Message.."></textarea>
							</div>
							<input type="submit" value="Send" class="btn btn-default">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>