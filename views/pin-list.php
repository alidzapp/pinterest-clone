<?php foreach ($pins as $pin) : ?>
	<div class="masonry-grid-item thumbnail" data-pinid="<?php echo $pin->id; ?>">
		<a href="<?php echo htmlspecialchars($pin->img_url); ?>"
		data-lightbox="<?php echo htmlentities(htmlspecialchars($pin->title)); ?>"
		data-title="<?php echo htmlentities(htmlspecialchars($pin->title)); ?>">
			<img src="<?php echo $pin->img_url; ?>" alt="<?php echo htmlspecialchars($pin->title); ?>" title="Enlarge">
		</a>
		<div class="caption">
			<h4><?php echo htmlspecialchars($pin->title); ?></h4>
			<?php if (User::pinAuthor($pin->username)) : ?>
				<span class="likes-block"><?php echo $pin->likes, " likes ", $pin->reposts, " reposts"; ?></span>
				<a href="removepin.php?id=<?php echo $pin->id; ?>" class="pull-left">Remove</a>
			<?php else : ?>
				<span class="likes-block">
					<span class="likes">
						<span class="likes-amount"><?php echo $pin->likes; ?></span> likes
					</span>
					<span class="reposts">
						<span class="reposts-amount"><?php echo $pin->reposts; ?></span> reposts
					</span>
				</span>
				<a href="viewprofile.php?user=<?php echo urlencode($pin->username); ?>" class="pull-left">
					<?php echo htmlspecialchars($pin->username); ?>
				</a>
			<?php endif; ?>
			<a href="viewpin.php?id=<?php echo $pin->id; ?>" class="pull-right">Discuss</a>
		</div>
	</div>
<?php endforeach; ?>