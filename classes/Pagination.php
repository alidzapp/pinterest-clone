<?php

class Pagination {
	public $page, $limit, $start, $totalRows, $totalPages, $offset, $limits;
	private $_db;

	public function __construct() {
		$this->page = isset($_GET["page"]) && (int) $_GET["page"] > 1 ? (int) $_GET["page"] : 1;
		$this->limit = isset($_GET["limit"]) && (int) $_GET["limit"] <= 50 && $_GET["limit"] > 0 ? (int) $_GET["limit"] : 20;
		$this->start = $this->page > 1 ? $this->page * $this->limit - $this->limit : 0;
		$this->_db = DB::getInstance();
		$this->limits = array(5,10,20,25,35,50);
	}

	public function totalRows() {
		$this->totalRows = $this->_db
			->query("SELECT FOUND_ROWS() AS total_rows")
			->results()[0]->total_rows;
		$this->totalPages = ceil($this->totalRows / $this->limit);
	}

	public function totalPages() {
		return $this->totalPages;
	}

	// html stuff
	public function pageOffset($offset = 3) {
		$this->offset = array(
			"start" => $this->page > $offset ? $this->page - $offset : $this->page - $this->page + 1,
			"end" => $this->page + $offset <= $this->totalPages ? $this->page + $offset : $this->totalPages
		);
	}
}