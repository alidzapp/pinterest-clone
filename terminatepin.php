<?php

require "core/init.php";

if (User::isLoggedIn() && isset($_POST["pinid"]) && is_numeric(Input::get("pinid"))) {
	$pin = Pin::find(Input::get("pinid"));
	if ($pin->results()[0]->username === Session::get("user")) {
		$name = htmlspecialchars($pin->results()[0]->title);
		Pin::remove(Input::get("pinid"));
		Session::flash("pinremove-success", sprintf("Removed pin '%s'.", $name));
		Redirect::to("mypins.php");
	}
}

die("Error. Somthing went wrong.");