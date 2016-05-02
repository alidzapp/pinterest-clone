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

	public static function getByUser($username) {
		$sql = "SELECT t1.id, t1.title, t1.img_url, t3.username, COUNT(DISTINCT t2.liked_by) as likes, COUNT(DISTINCT t4.reposted_by) as reposts FROM `pins` t1 LEFT JOIN likes t2 ON t1.id=t2.pin_id LEFT JOIN reposts t4 ON t1.id=t4.pin_id INNER JOIN users t3 ON t1.author_id=t3.id WHERE t1.author_id=(SELECT id FROM users WHERE username=?) GROUP BY t1.title UNION ALL SELECT t3.id, t3.title, t3.img_url, t4.username, COUNT(t5.liked_by) as likes, COUNT(t2.reposted_by) as reposts FROM `users` t1 INNER JOIN reposts t2 ON t1.id=t2.reposted_by INNER JOIN pins t3 ON t2.pin_id=t3.id INNER JOIN users t4 ON t3.author_id=t4.id LEFT JOIN likes t5 ON t2.pin_id=t5.pin_id WHERE t1.username=? GROUP BY t3.title ORDER BY likes DESC";
		return DB::getInstance()->query($sql, array($username, $username));
	}

	public static function getPin($id) {
		$sql = "SELECT * from pins INNER JOIN users on pins.author_id=users.id WHERE pins.id=?";
		return DB::getInstance()->query($sql, array($id));
	}

	public static function getAllPins() {
		$sql = "SELECT pins.id, pins.img_url, pins.title, users.username, COUNT(DISTINCT likes.id) AS likes, COUNT(DISTINCT reposts.id) AS reposts FROM pins INNER JOIN users ON pins.author_id=users.id LEFT JOIN likes ON pins.id=likes.pin_id LEFT JOIN reposts on pins.id=reposts.pin_id GROUP BY pins.id ORDER BY likes DESC";
		return DB::getInstance()->query($sql);
	}
}