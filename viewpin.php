<?php
require "models/viewpin.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>View Pin</title>
	<?php require "partials/stylesheets.html"; ?>
	<link rel="stylesheet" href="assets/css/lightbox.min.css">
</head>
<body>
	<div class="container">
		<?php require "partials/navbar.php"; ?>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="main-header"><?php echo isset($pin) && !empty($pin) ? "Discuss" : "Nothing found"; ?></h1>
				<ol class="breadcrumb clear-padding">
					<li><a href="index.php">Home</a></li>
					<li class="active">View Pin</li>
				</ol>
				<hr>
			</div>

			<?php if (isset($pin) && !empty($pin)) : ?>
				<div class="col-sm-12">
					<div class="row">
						<?php require "views/singlepin.php"; ?>
						<div class="col-sm-12">
							<h4>0 comment(s)</h4>
							<hr>
							<?php if (User::isLoggedIn()) : ?>
								<form action="" method="post">
									<div class="form-group">
										<label>Leave a comment</label>
										<textarea name="comment" rows="10" class="form-control"></textarea>
									</div>
									<input type="submit" value="Send" class="btn btn-default">
								</form>
							<?php else : ?>
								<strong><a href="login.php">Log in</a> to leave a reply.</strong>
							<?php endif; ?>
							<hr>
						</div>
					</div>
				</div>

				<div class="col-sm-12">
					<div class="row">
					<div class="media">
						  <div class="media-left">
						      <h1 class="glyphicon glyphicon-user"></h1>
						  </div>
						  <div class="media-body">
						    <h4 class="media-heading">User says:</h4>
						    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit consequatur facere magni architecto nostrum sequi ut totam magnam dolorem dolores facilis, obcaecati aliquam distinctio. Similique est temporibus, aspernatur cum debitis, a voluptas repudiandae minus ea deserunt cumque velit ducimus soluta, laborum dolor doloribus distinctio. Aspernatur quia hic, nulla ab velit, culpa labore magni magnam placeat sequi, nostrum, omnis veritatis aliquam modi reprehenderit vel non! Esse at hic nostrum dignissimos sed officiis, similique labore ducimus ab, asperiores maxime dolorum! Molestiae quis aliquam voluptatem neque, earum eius incidunt animi at voluptas? Ipsa tenetur neque assumenda, labore voluptate possimus odio dolorum atque impedit.</p>
						    <div class="media-info" style="opacity:0.8">5. may 2016</div>
						  </div>
						</div>
						<div class="media">
						  <div class="media-left">
						      <h1 class="glyphicon glyphicon-user"></h1>
						  </div>
						  <div class="media-body">
						    <h4 class="media-heading">User says:</h4>
						    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit consequatur facere magni architecto nostrum sequi ut totam magnam dolorem dolores facilis, obcaecati aliquam distinctio. Similique est temporibus, aspernatur cum debitis, a voluptas repudiandae minus ea deserunt cumque velit ducimus soluta, laborum dolor doloribus distinctio. Aspernatur quia hic, nulla ab velit, culpa labore magni magnam placeat sequi, nostrum, omnis veritatis aliquam modi reprehenderit vel non! Esse at hic nostrum dignissimos sed officiis, similique labore ducimus ab, asperiores maxime dolorum! Molestiae quis aliquam voluptatem neque, earum eius incidunt animi at voluptas? Ipsa tenetur neque assumenda, labore voluptate possimus odio dolorum atque impedit.</p>
						  </div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php require "partials/jquerybootstrap.html"; ?>
	<script src="assets/js/like.js"></script>
	<script src="assets/js/jslightbox.min.js"></script>
</body>
</html>