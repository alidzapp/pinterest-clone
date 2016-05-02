<?php

class DB {
	private static $_instance = null;
	private $_pdo, $_query, $_error = false, $_results, $_count = 0, $_lastId;

	private function __construct() {
		try {
			$this->_pdo = new PDO("mysql:host=127.0.0.1;dbname=pinterest_clone", "pinterest_admin", "pinterest");
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance() {
		if (!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}

	public function query($sql, $params = array()) {
		if ($this->_query = $this->_pdo->prepare($sql)) {
			if (count($params)) {
				$x = 1;
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}

			if ($this->_query->execute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
				$this->_lastId = $this->_pdo->lastInsertId();
			} else {
				$this->_error = true;
			}
		}

		return $this;
	}

	public function lastId() {
		return $this->_lastId;
	}

	public function results() {
		return $this->_results;
	}

	public function count() {
		return $this->_count;
	}

	public function error() {
		return $this->_error;
	}
}