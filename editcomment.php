<?php

header("Content-Type: application/json");
require "core/init.php";

if (User::isLoggedIn()) {
	if (isset($_POST["id"], $_POST["newComment"]) && (int) $_POST["id"] > 0) {
		if (Session::get("user") === Comment::getAuthor((int) $_POST["id"])) {
			Comment::update((int) $_POST["id"], $_POST["newComment"]);
			echo json_encode(array("edited" => 1));
		} else {
			echo json_encode(array("err" => 1));
		}
	}
} else {
	echo json_encode(array("err" => "not logged in"));
}