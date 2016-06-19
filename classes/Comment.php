<?php

class Comment {
	private $_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function create($authorId, $pinId, $body) {
		$this->_db->query("INSERT INTO comments (author, pin, body) VALUES (?, ?, ?)", array($authorId, $pinId, $body));
	}

	public static function remove($id) {
		DB::getInstance()->query("DELETE FROM comments WHERE id=?", array($id));
	}

	public static function update($id, $body) {
		DB::getInstance()->query("UPDATE comments SET body=? WHERE id=?", array($body, $id));
	}

	public static function getAuthor($id) {
		$sql = "
			SELECT u.username
			FROM comments c
			INNER JOIN users u ON c.author=u.id
			WHERE c.id=?
		";
		$user = DB::getInstance()->query($sql, array($id));
		return $user->results()[0]->username;
	}

	public static function author($username) {
		if (User::isLoggedIn()) {
			return $username === Session::get("user");
		}
		return null;
	}
}