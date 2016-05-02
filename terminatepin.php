<?php

require "core/init.php";

if (User::isLoggedIn() && Input::fieldExists("pinid") && is_numeric(Input::get("pinid"))) {
	$pin = Pin::getPin(Input::get("pinid"));
	if ($pin->results()[0]->username === Session::get("user")) {
		$name = htmlspecialchars($pin->results()[0]->title);
		DB::getInstance()->query("DELETE FROM pins WHERE id=?", array(Input::get("pinid")));
		Session::flash("pinremove-success", sprintf("Removed pin '%s'.", $name));
		Redirect::to("mypins.php");
	}
}

die("Error. Somthing went wrong.");