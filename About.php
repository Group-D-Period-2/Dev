	<?php
	$pageTitle = "About Us";
	$underline = "a";
	include('inc/header.php'); ?>
	<div class="section">
		<h3>About Us</h3>

		<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
	</div>

	<h2>Dine With Us</h2>

	<div class="Row">
		<div class="column">
			<div class="part">
				<img src="breado.jpg" alt="breado" id="bread">
				<div class="container">
					<h2>What We Offer!</h2>
					<p>We are known for our wide variety of sandwiches passed on from generation to generation. Check out our menu and what we have to offer and be part of the Family!</p>

					<a href="menu.php">
						<p><button class="button">Menu</button></p>
					</a>
				</div>
			</div>
		</div>

		<div class="column">
			<div class="part">
				<img src="location.png" alt="location" id="link">
				<div class="container">
					<h2>Locations Near You</h2>
					<p>Discover A location near you and visit one of our kitchens and experience the best sandwiches.</p>
					<a href="location.php">
						<p><button class="button">Location</button></p>
					</a>
				</div>
			</div>
		</div>

		<footer>
			<?php include('inc/footer.php'); ?>
		</footer>
	</div>
	</body>

	</html>