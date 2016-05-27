<?php

header("Content-Type: application/json");
require "core/init.php";

if (!User::isLoggedIn()) {
	echo json_encode(array("err" => "not logged in"));
} else if (isset($_POST["pinid"])) {
	// check if pin exists
	$pin = Pin::find(Input::get("pinid"));
	if ($pin->count()) {
		$results = $pin->results()[0];
		$author = $results->username;
		// cant like own pin
		if ($author !== Session::get("user")) {
			$sql = "SELECT id FROM users WHERE username=?";
			$userId = DB::getInstance()->query($sql, array(Session::get("user")))->results()[0]->id;
			// need to check if user has already liked said pin
			// if he hasnt add a like to db
			$sql = "SELECT id FROM likes WHERE pin_id=? AND liked_by=?";
			$like = DB::getInstance()->query($sql, array(Input::get("pinid"), $userId));
			if (!$like->count()) {
				// need to create like
				Like::create(Input::get("pinid"), $userId);
				echo json_encode(array("liked" => 0));
			} else {
				// need to remove like from db (dislike)
				$likeId = $like->results()[0]->id;
				Like::removeLike($likeId);
				echo json_encode(array("liked" => 1));
			}
		} else {
			echo json_encode(array("err" => "cant like your own pin"));
		}
	} else {
		echo json_encode(array("err" => "pin doesnt exist"));
	}
}