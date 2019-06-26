<?php 
require_once 'session.php';

?>
<!DOCTYPE html>
<html>
<head>
	<?php 
	$pageTitle = "User Manual";
	include 'php/headTag.php'; 
	?>
</head>
<body>
	<div id="mainBody">
		
		<?php include 'php/nav.php'; ?>

		<div id="landing" class="box">
			<div><?php echo $pageTitle; ?></div>
		</div>

		<div class="box tc manual">
			<h4 class="mbtm b">Login and Regsitration</h4>
			<img src="img/manual/loginRegister.PNG">
			<p>User can login and regsiter from our home page login and registration form.</p>
		</div>

		<div class="box tc manual">
			<h4 class="mbtm b">Search Flights</h4>
			<img src="img/manual/search.PNG">
			<p>User can search flights.</p>
		</div>

		<div class="box tc manual">
			<h4 class="mbtm b">Book Flights</h4>
			<img src="img/manual/book.PNG">
			<p>User can search flights and book them.</p>
		</div>

		<div class="box tc manual">
			<h4 class="mbtm b">Update Profile</h4>
			<img src="img/manual/updateProfile.PNG">
			<p>Users can update their profile.</p>
		</div>

		<div class="box tc manual">
			<h4 class="mbtm b">Update Password</h4>
			<img src="img/manual/updatePassword.PNG">
			<p>Users can update their password.</p>
		</div>

	</div>
</body>
</html>