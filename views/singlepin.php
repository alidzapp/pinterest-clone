<div class="col-sm-12">
	<div class="thumbnail" data-pinid="<?php echo $pin->id; ?>">
		<a href="<?php echo htmlspecialchars($pin->img_url); ?>" data-lightbox="pin">
			<img src="<?php echo htmlspecialchars($pin->img_url); ?>" alt="<?php echo htmlspecialchars($pin->title); ?>" title="Enlarge">
		</a>
		<div class="caption">
			<h3><?php echo htmlspecialchars($pin->title); ?></h3>
			<span><?php echo $pin->date_added; ?></span>
			<br><br>
			<?php if (User::pinAuthor($pin->username)) : ?>
				<span class="likes-block"><?php echo $pin->likes, " likes ", $pin->reposts, " reposts" ?></span>
				<a href="removepin.php?id=<?php echo $pin->id; ?>">Remove</a>
			<?php else : ?>
				<span class="likes-block">
					<span class="likes">
						<span class="likes-amount"><?php echo $pin->likes; ?></span> likes
					</span>
					<span class="reposts">
						<span class="reposts-amount"><?php echo $pin->reposts; ?></span> reposts
					</span>
				</span>
				<a href="viewprofile.php?user=<?php echo urlencode($pin->username); ?>"><?php echo htmlspecialchars($pin->username); ?></a>
			<?php endif; ?>
		</div>
	</div>
</div>
<div class="col-sm-12">
	<h4><?php echo $pin->comments; ?> comment(s)</h4>
</div>