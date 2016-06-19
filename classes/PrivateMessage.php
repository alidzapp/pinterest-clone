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

	public static function find($id) {
		$sql = "
			SELECT id, sender, recipient, subject, body, DATE_FORMAT(send_time, '%d-%m-%Y %k:%i') AS send_time
			FROM private_messages
			WHERE id=?
		";
		if ($pm = DB::getInstance()->query($sql, array($id))->results()) {
			return $pm[0];
		}

		return null;
	}
}