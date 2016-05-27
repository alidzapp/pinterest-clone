<?php

header("Content-Type: application/json");
require "core/init.php";

if (User::isLoggedIn()) {
	if (isset($_POST["id"]) && (int) $_POST["id"] > 0) {
		// echo Comment::getAuthor($_POST["id"]);
		if (Session::get("user") === Comment::getAuthor((int) $_POST["id"])) {
			Comment::remove((int) $_POST["id"]);
			echo json_encode(array("removed" => 1));
		} else {
			echo json_encode(array("err" => 1));
		}
	}
} else {
	echo json_encode(array("err" => "not logged in"));
}