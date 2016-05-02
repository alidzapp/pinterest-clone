<?php

class Repost {
	private $_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public static function removeRepost($id) {
		DB::getInstance()->query("DELETE FROM reposts WHERE id=?", array($id));
	}

	public static function create($pinId, $userId) {
		DB::getInstance()->query("INSERT INTO reposts (pin_id, reposted_by) VALUES (?, ?)", array($pinId, $userId));
	}
}