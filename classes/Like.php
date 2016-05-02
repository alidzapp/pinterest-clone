<?php

class Like {
	private $_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public static function removeLike($id) {
		DB::getInstance()->query("DELETE FROM likes WHERE id=?", array($id));
	}

	public static function create($pinId, $userId) {
		DB::getInstance()->query("INSERT INTO likes (pin_id, liked_by) VALUES (?, ?)", array($pinId, $userId));
	}
}