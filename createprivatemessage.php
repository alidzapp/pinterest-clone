<?php

require "core/init.php";

if (!User::isLoggedIn()) {
	Redirect::to("login.php");
}

if (isset($_POST["recipient"], $_POST["subject"], $_POST["messageBody"])) {
	$validate = new Validate();
	$validate->check($_POST);

	if ($validate->passed()) {
		$senderId = User::find(Session::get("user"))->id;
		$recipientId = User::find($_POST["recipient"])->id;
		$pm = new PrivateMessage();
		$pm->create($senderId, $recipientId, $_POST["subject"], $_POST["messageBody"]);
		Session::flash("sendPm-success", "New message sent to " . $_POST["recipient"]);
	} else {
		Session::flash("sendPm-error", "Failed to send message.");
	}
} else {
	Session::flash("sendPm-error", "Failed to send message.");
}

Redirect::to("inbox.php");