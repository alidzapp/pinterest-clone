<?php
require "core/init.php";
if (!User::isLoggedIn()) {
	Redirect::to("login.php");
}

$user = DB::getInstance()->query("SELECT * FROM users WHERE username=?", array(Session::get("user")))->results()[0];

if (isset($_POST["firstname"]) || isset($_POST["lastname"]) || isset($_POST["email"]) || isset($_POST["username"])) {
	if (Input::get("firstname") !== $user->first_name ||
		Input::get("lastname") !== $user->last_name ||
		Input::get("email") !== $user->email ||
		Input::get("username") !== $user->username)
	{
		$validateArr = array();
		if (!empty(Input::get("firstname")) && Input::get("firstname") !== $user->first_name) {
			$validateArr["firstname"] = Input::get("firstname");
		}
		if (!empty(Input::get("lastname")) && Input::get("lastname") !== $user->last_name) {
			$validateArr["lastname"] = Input::get("lastname");
		}
		if (!empty(Input::get("email")) && Input::get("email") !== $user->email) {
			$validateArr["email"] = Input::get("email");
		}
		if (!empty(Input::get("username")) && Input::get("username") !== $user->username) {
			$validateArr["username"] = Input::get("username");
		}
		if (!empty($validateArr)) {
			$validate = new Validate();
			$validate->check($validateArr);

			if ($validate->passed()) {
				$fields = array();
				$values = array();
				$sql = "UPDATE users SET ";
				if (!empty(Input::get("firstname")) && Input::get("firstname") !== $user->first_name) {
					$fields[] = "first_name";
					$values[] = Input::get("firstname");
				}
				if (!empty(Input::get("lastname")) && Input::get("lastname") !== $user->last_name) {
					$fields[] = "last_name";
					$values[] = Input::get("lastname");
				}
				if (!empty(Input::get("email")) && Input::get("email") !== $user->email) {
					$fields[] = "email";
					$values[] = Input::get("email");
				}
				if (!empty(Input::get("username")) && Input::get("username") !== $user->username) {
					$fields[] = "username";
					$values[] = Input::get("username");
				}

				for ($i = 0; $i < count($fields); $i++) {
					if ($i === count($fields) - 1) {
						$sql .= $fields[$i] . "=? ";
					} else {
						$sql .= $fields[$i] . "=?,";
					}
				}

				$sql .= "WHERE username=?";
				$values[] = Session::get("user");
				// echo $sql;
				// print_r($values);
				$response = DB::getInstance()->query($sql, $values);
				if (in_array("username", $fields) && !$response->error()) {
					Session::set("user", Input::get("username"));
				}
				Session::flash("editprofile-success", "Profile updated.");
				Redirect::to("editprofile.php");
			} else {
				// $msg = "";
				// $errors = $validate->errors();
				// foreach($errors as $error) {
				// 	$msg .= $error . "<br>";
				// }
				Session::flash("editprofile-error", "Error updating profile.");
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit Profile</title>
	<?php require "partials/stylesheets.html"; ?>
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header">Edit Profile</h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li><a href="settings.php">Settings</a></li>
					<li class="active">Edit Profile</li>
				</ol>
				<hr>
			</div>
			<div class="col-sm-12">
				<form action="editprofile.php" method="post">
					<div class="col-sm-6 clear-padding">
						<?php
							if (Session::exists("editprofile-error")) {
								printf('<div class="alert alert-danger"><strong>%s</strong></div>', Session::flash("editprofile-error"));
							} elseif (Session::exists("editprofile-success")) {
								printf('<div class="alert alert-success"><strong>%s</strong></div>', Session::flash("editprofile-success"));
							}
						?>
						<div class="form-group <?php if (isset($validate) && $validate->error("firstname")) echo " has-error"; ?>">
							<label>First Name</label>
							<?php if (isset($validate)) echo $validate->error("firstname"); ?>
							<input type="text" name="firstname" class="form-control" value="<?php if (isset($_POST["firstname"])) echo htmlspecialchars(Input::get("firstname")); ?>" placeholder="<?php echo $user->first_name;  ?>">
						</div>
						<div class="form-group <?php if (isset($validate) && $validate->error("lastname")) echo " has-error"; ?>">
							<label>Last Name</label>
							<?php if (isset($validate)) echo $validate->error("lastname"); ?>
							<input type="text" name="lastname" class="form-control" value="<?php if (isset($_POST["lastname"])) echo htmlspecialchars(Input::get("lastname")); ?>" placeholder="<?php echo $user->last_name;  ?>">
						</div>
						<div class="form-group <?php if (isset($validate) && $validate->error("email")) echo " has-error"; ?>">
							<label>Email</label>
							<?php if (isset($validate)) echo $validate->error("email"); ?>
							<input type="email" name="email" class="form-control" value="<?php if (isset($_POST["email"])) echo htmlspecialchars(Input::get("email")); ?>" placeholder="<?php echo $user->email;  ?>">
						</div>
						<div class="form-group <?php if (isset($validate) && $validate->error("username")) echo " has-error"; ?>">
							<label>Username</label>
							<?php if (isset($validate)) echo $validate->error("username"); ?>
							<input type="text" name="username" class="form-control" value="<?php if (isset($_POST["username"])) echo htmlspecialchars(Input::get("username")); ?>" placeholder="<?php echo $user->username;  ?>">
						</div>
						<input type="submit" value="Update" class="btn btn-default">
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
</body>
</html>