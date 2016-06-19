<div class="row">
	<div class="col-sm-12">
		<ul class="pagination">
			<li title="First page"><a href="<?php echo "?page=1&limit=", $pagination->limit, isset($name) ? "&user=" . urlencode($name) : ""; ?>">First</a></li>
			<?php for ($i = $pagination->offset["start"]; $i <= $pagination->offset["end"]; $i++) : ?>
				<li class="<?php if ($i === $pagination->page) echo "active"; ?>"><a href="<?php echo "?page=", $i, "&limit=", $pagination->limit, isset($name) ? "&user=" . urlencode($name) : ""; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
			<li title="Last page">
				<a href="<?php echo "?page=", $pagination->totalPages, "&limit=", $pagination->limit, strtok($_SERVER["REQUEST_URI"], "?") === "/viewprofile.php" ? "&user=" . urlencode($name) : ""; ?>">Last
				</a>
			</li>
		</ul>
	</div>
</div>