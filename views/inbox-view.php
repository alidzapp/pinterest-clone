<?php foreach ($pms as $pm) : ?>
	<tr>
		<td>
			<a href="viewmessage.php?id=<?php echo htmlspecialchars($pm->id); ?>">
				<?php echo htmlspecialchars($pm->subject); ?>
			</a>
		</td>
		<td><?php echo htmlspecialchars($pm->sender); ?></td>
		<td><?php echo htmlspecialchars($pm->send_time); ?></td>
		<td></td>
	</tr>
<?php endforeach; ?>