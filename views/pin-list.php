<?php

foreach ($pins as $pin) {
	echo '<div class="masonry-grid-item thumbnail" data-pinid="', $pin->id, '">';
	echo '<a href="', $pin->img_url, '" data-lightbox="', htmlentities(htmlspecialchars($pin->title)), '" data-title="', htmlentities(htmlspecialchars($pin->title)), '">';
	echo '<img src="', $pin->img_url, '" alt="', htmlspecialchars($pin->title), '" title="Enlarge"></a>';
	echo '<div class="caption">';
	echo '<h4>', htmlspecialchars($pin->title), '</h4>';
	if (User::pinAuthor($pin->username)) {
		echo '<span class="likes-block">', $pin->likes, ' likes ', $pin->reposts, ' reposts</span>';
		echo '<a class="pull-left" href="removepin.php?id=', $pin->id, '">Remove</a>';
	} else {
		echo '<span class="likes-block"><span class="likes"><span class="likes-amount">', $pin->likes, '</span> likes</span> <span class="reposts"><span class="reposts-amount">', $pin->reposts, '</span> reposts</span></span>';
		echo '<a class="pull-left" href="viewprofile.php?user=', urlencode($pin->username), '">', htmlspecialchars($pin->username), '</a>';
	}
	echo '<a class="pull-right" href="viewpin.php?id=', $pin->id, '">Discuss</a>';
	echo '</div></div>';
}