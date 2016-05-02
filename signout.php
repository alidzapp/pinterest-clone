<?php

require "core/init.php";

if (User::isLoggedIn()) {
	User::logOut();
}

Redirect::to("index.php");