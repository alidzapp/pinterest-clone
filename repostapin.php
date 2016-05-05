<?php
require "core/init.php";

if (!User::isLoggedIn()) {
	echo json_encode(array("err" => "not logged in"));
} else if (isset($_POST["pinid"])) {
	// check if pin exists
	$pin = Pin::getPin(Input::get("pinid"));
	if ($pin->count()) {
		$results = $pin->results()[0];
		$author = $results->username;
		// cant repost own pin
		if ($author !== Session::get("user")) {
			$sql = "SELECT id FROM users WHERE username=?";
			$userId = DB::getInstance()->query($sql, array(Session::get("user")))->results()[0]->id;
			// need to check if user has already reposted said pin
			// if he hasnt add a repost to db
			$sql = "SELECT id FROM reposts WHERE pin_id=? AND reposted_by=?";
			$repost = DB::getInstance()->query($sql, array(Input::get("pinid"), $userId));
			if (!$repost->count()) {
				// need to create repost
				Repost::create(Input::get("pinid"), $userId);
				echo json_encode(array("reposted" => false));
			} else if ($repost->count()) {
				// need to remove repost from db
				$repostId = $repost->results()[0]->id;
				Repost::removeRepost($repostId);
				echo json_encode(array("reposted" => true));
			}
		} else {
			echo "cant repost your own pin";
		}
	} else {
		echo "pin doesnt exist";
	}
}