<?php

class Input {
	public static function exists($type = "post") {
		switch ($type) {
			case "post":
				return (!empty($_POST)) ? true : false;
			case "get":
				return (!empty($_GET)) ? true : false;
			default:
				return false;
		}
	}

	public static function fieldExists($item, $type = "post") {
		switch ($type) {
			case "post":
				return isset($_POST[$item]);
			case "get":
				return isset($_GET[$item]);
			default:
				return false;
		}
	}

	public static function get($item) {
		if (isset($_POST[$item])) {
			return $_POST[$item];
		} elseif (isset($_GET[$item])) {
			return $_GET[$item];
		}
		return "";
	}
}