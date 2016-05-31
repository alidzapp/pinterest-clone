<h4>
	<span class="bold-text">Subject:</span>
	<?php echo htmlspecialchars($pm->subject); ?>
</h4>
<h5>
	<span class="bold-text">From:</span>
	<a href="viewprofile.php?user=<?php echo urlencode($sender); ?>">
		<?php echo htmlspecialchars($sender); ?>
	</a>
</h5>
<h5><span class="bold-text">When:</span> <?php echo htmlspecialchars($pm->send_time); ?></h5>
<p><span class="bold-text">Message:</span></p>
<textarea class="form-control" disabled><?php echo htmlspecialchars($pm->body); ?></textarea>