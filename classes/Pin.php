<?php

class Pin {
	private $_db = null;

	public function __construct() {
		$this->_db = DB::getInstance();
	}

	public function create($username, $name, $img) {
		$user = $this->_db->query("SELECT id FROM users WHERE username=?", array($username));
		$id = $user->results()[0]->id;
		$this->_db->query("INSERT INTO pins (author_id, title, img_url) VALUES (?, ?, ?)", array($id, $name, $img));
	}

	public static function getPin($id) {
		$sql = "SELECT * from pins INNER JOIN users on pins.author_id=users.id WHERE pins.id=?";
		return DB::getInstance()->query($sql, array($id));
	}

	public static function getAllPins($start, $end) {
		$sql = "
			SELECT SQL_CALC_FOUND_ROWS pins.id, pins.img_url, pins.title, users.username, COUNT(DISTINCT likes.id) AS likes, COUNT(DISTINCT reposts.id) AS reposts
			FROM pins
			INNER JOIN users ON pins.author_id=users.id
			LEFT JOIN likes ON pins.id=likes.pin_id
			LEFT JOIN reposts on pins.id=reposts.pin_id
			GROUP BY pins.id
			ORDER BY likes DESC
			LIMIT {$start}, {$end}";

		return DB::getInstance()->query($sql);
	}
}