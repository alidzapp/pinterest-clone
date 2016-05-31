<?php

class PrivateMessage {
	private $_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function create($sender, $recipient, $subject, $body) {
		$this->_db->query(
			"INSERT INTO private_messages (sender, recipient, subject, body) VALUES (?, ?, ?, ?)",
			array($sender, $recipient, $subject, $body)
		);
	}
}