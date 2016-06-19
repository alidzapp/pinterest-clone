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

	public static function pinAuthor($username) {
		if (self::isLoggedIn()) {
			return Session::get("user") === $username;
		}
		return false;
	}

	public static function findById($id) {
		if ($user = DB::getInstance()->query("SELECT * FROM users WHERE id=?", array($id))->results()) {
			return $user[0];
		}
		return null;
	}

	public static function find($username) {
		return DB::getInstance()
			->query("SELECT * FROM users WHERE username=?", array($username))
			->results()[0];
	}

	public static function pins($username, $start, $end) {
		// binding for limit is hard
		$sql = "
			SELECT SQL_CALC_FOUND_ROWS t1.id, t1.title, t1.img_url, t3.username, COUNT(DISTINCT t2.liked_by) AS likes, COUNT(DISTINCT t4.reposted_by) AS reposts
			FROM `pins` t1
			LEFT JOIN likes t2 ON t1.id=t2.pin_id
			LEFT JOIN reposts t4 ON t1.id=t4.pin_id
			INNER JOIN users t3 ON t1.author_id=t3.id
			WHERE t1.author_id=(SELECT id FROM users WHERE username=?)
			GROUP BY t1.title
			UNION ALL
			SELECT t3.id, t3.title, t3.img_url, t4.username, COUNT(t5.liked_by) AS likes, COUNT(t2.reposted_by) AS reposts
			FROM `users` t1
			INNER JOIN reposts t2 ON t1.id=t2.reposted_by
			INNER JOIN pins t3 ON t2.pin_id=t3.id
			INNER JOIN users t4 ON t3.author_id=t4.id
			LEFT JOIN likes t5 ON t2.pin_id=t5.pin_id WHERE t1.username=?
			GROUP BY t3.title
			ORDER BY likes DESC
			LIMIT {$start}, {$end}";

		return DB::getInstance()->query($sql, array($username, $username));
	}

	public static function privateMessages($username) {
		$sql = "
			SELECT pm.id, pm.subject, pm.body, u.username AS sender, DATE_FORMAT(pm.send_time, '%d-%m-%Y %k:%i') AS send_time
			FROM private_messages pm
			INNER JOIN users u ON pm.sender=u.id
			WHERE recipient=(
				SELECT id
			    FROM users
			    WHERE username=?
			)
			ORDER BY pm.id DESC;
		";

		return DB::getInstance()->query($sql, array($username))->results();
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