<?php
require "core/init.php";
if (isset($_GET["id"]) && (int) $_GET["id"] > 0) {
	$id = (int) $_GET["id"];
	$pin = DB::getInstance()->query("
		SELECT p.img_url, DATE_FORMAT(p.date_added, '%e. %b %Y') AS date_added, p.title, p.id, u.username, COUNT(DISTINCT l.id) AS likes, COUNT(DISTINCT r.id) AS reposts
		FROM pins p
		INNER JOIN users u ON p.author_id=u.id
		LEFT JOIN likes l ON p.id=l.pin_id
		LEFT JOIN reposts r ON p.id=r.pin_id
		WHERE p.id=?
		GROUP BY p.id",
		array($id)
	)->results()[0];

	if (!empty($pin)) {

	}
} else {
	Redirect::to("index.php");
}