<div class="row pagination-pagecount">
	<div class="col-sm-12">
		<?php printf('<p>Showing page %d of %d.</p>', $pagination->page, $pagination->totalPages); ?>
	</div>
	<div class="col-sm-12">
		<form action="" method="get">
			<?php if (strtok($_SERVER["REQUEST_URI"], "?") === "/viewprofile.php") : ?>
				<input type="text" hidden value="<?php echo htmlspecialchars($_GET["user"]); ?>" name="user">
			<?php endif; ?>
			<div class="form-group">
				<label>Show:</label>
				<select name="limit" onchange="this.form.submit()">
					<option value="<?php echo $limit; ?>" selected><?php echo $pagination->limit; ?></option>
					<?php foreach ($pagination->limits as $lim) : ?>
						<?php if ($lim !== $pagination->limit) : ?>
							<option value="<?php echo $lim; ?>"><?php echo $lim; ?></option>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</div>
		</form>
	</div>
</div>