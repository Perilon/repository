<?php
// Include the file in which are set the object of the classes for Login, Register, Recover-data, and User-page
// include('users/index.php');
?>
<!DOCTYPE HTML>
<!--
	Strongly Typed by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<!-- Head -->
	<?php include  'users.php'; ?>
	<?php include 'head.php';?>
	<?php $this_page = "prompts/manageuser.php";?>
	
		<div class="container">
			<?php echo $login; 
			if(isset($_SESSION['username'])) {
				if(isset($_SESSION['rank']) && $_SESSION['rank']>2) {
				?>
					<header>
						<h1>Manage Users</h1>
					</header>
			<div class="contr">
				<h2 style="color: white;">
					This page is under construction 
						<a href="app.php"><button class="button-bar">Return to Main Page</button></a>
				</h2>
			</div>				
			<?php 
			} else {
					//regular user (should not be here)
					echo "<h1>You don't belong here!</h1>";
				} 
			} ?>
			<br />
		</div>
		<!-- Footer -->
		<?php include 'footer.php';?>
	</body>
</html>