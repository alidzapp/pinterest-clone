<?php foreach ($comments as $comment) : ?>
	<div class="media pin-comment" id="<?php echo $comment->id; ?>">
		<div class="media-left">
			<h1 class="glyphicon glyphicon-user"></h1>
		</div>
		<div class="media-body">
			<h4 class="media-heading"><?php echo htmlspecialchars($comment->username); ?> says:</h4>
			<p class="comment-body"><?php echo htmlspecialchars($comment->body); ?></p>
			<div class="comment-date"><?php echo $comment->date_added; ?></div>
			<?php if (Comment::author($comment->username)) : ?>
				<span class="remove-comment">Remove</span> /
				<span class="edit-comment">Edit</span>
			<?php endif; ?>
		</div>
	</div>
<?php endforeach; ?>