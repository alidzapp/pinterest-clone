<?php

class Comment {
	private $_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function create($authorId, $pinId, $body) {
		$this->_db->query("INSERT INTO comments (author, pin, body) VALUES (?, ?, ?)", array($authorId, $pinId, $body));
	}
}