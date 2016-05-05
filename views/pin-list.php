<?php

function isAuthor($username) {
	if (User::isLoggedIn()) {
		return Session::get("user") === $username;
	}
	return false;
}

foreach($pins->results() as $pin) {
	$pin->title = htmlspecialchars($pin->title);
	echo '<div class="masonry-grid-item thumbnail" data-pinid="', $pin->id, '">';
	echo '<a href="', $pin->img_url, '" data-lightbox="images">';
	echo '<img src="', $pin->img_url, '" alt="', $pin->title, '" title="Enlarge"></a>';
	echo '<div class="caption">';
	echo '<h4>', $pin->title, '</h4>';
	if (isAuthor($pin->username)) {
		echo '<span class="likes-block">', $pin->likes, ' likes ', $pin->reposts, ' reposts</span>';
		echo '<a href="removepin.php?id=', $pin->id, '">Remove</a>';
	} else {
		echo '<span class="likes-block"><span class="likes"><span class="likes-amount">', $pin->likes, '</span> likes</span> <span class="reposts"><span class="reposts-amount">', $pin->reposts, '</span> reposts</span></span>';
		echo '<a href="viewprofile.php?user=', urlencode($pin->username), '">', htmlspecialchars($pin->username), '</a>';
	}
	echo '</div></div>';
}




// printf('
	// 	<div class="masonry-grid-item thumbnail">
	// 		<img src="%s">
	// 		<div class="caption">
	// 			<h4>%s</h4>
	// 			<span class="likes">%d likes %d reposts</span>
	// 			<a href="removepin.php?id=%d">remove</a>
	// 		</div>
	// 	</div>',
	// 	$pin->img_url,
	// 	htmlspecialchars($pin->title),
	// 	$pin->likes,
	// 	$pin->reposts,
	// 	$pin->id
	// );