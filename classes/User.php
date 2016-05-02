<?php

class User {
	private $_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function create($firstName = "", $lastName = "", $username, $email, $password) {
		$user = array(
			$firstName,
			$lastName,
			$username,
			$email,
			password_hash($password, PASSWORD_DEFAULT)
		);
		$this->_db->query("INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)", $user);
	}

	public static function isLoggedIn() {
		if (Session::exists("user")) {
			return true;
		}
		return false;
	}

	public static function logIn($username, $pass) {
		$sql = "SELECT password FROM users WHERE username=?";
		$user = DB::getInstance()->query($sql, array($username));
		if ($user->count()) {
			$hash = $user->results()[0]->password;
			if (password_verify($pass, $hash)) {
				return true;
			}
			Session::flash("login-error", "Invalid password.");
		} else {
			Session::flash("login-error", "User not found.");
		}
		return false;
	}

	public static function logOut() {
		Session::delete("user");
	}
}