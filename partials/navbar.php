<div class="nav-wrapper">
	<div class="jumbotron main-bg"></div>
	<nav class="nav navbar-default main-nav">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#hamburger" aria-expanded="false">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Pinterest</a>
		</div>
		<div class="collapse navbar-collapse" id="hamburger">
			<ul class="nav navbar-nav">
				<li><a href="allpins.php">All Pins</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if (!isset($_SESSION["user"])) : ?>
					<li><a href="login.php">Login</a></li>
					<li><a href="signup.php">Sign Up</a></li>
				<?php else : ?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo htmlspecialchars(Session::get("user")) ?> <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="newpin.php">New Pin</a></li>
							<li><a href="mypins.php">My Pins</a></li>
							<li><a href="settings.php">Settings</a></li>
						</ul>
					</li>
					<li><a href="signout.php">Sign Out</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</nav>
</div>