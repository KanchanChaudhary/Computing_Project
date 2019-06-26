<?php 
	
	echo '

		<nav>
			<div class="navLeft">
				<span id="logo"><img src="img/logo.png"></span>
				<span id="logoText">Online Air Ticketing</span>
			</div>
			<div class="navRight">';
				
				if ( $loggedIn ) {
					echo '
						<a href="logout.php" class="lout">Logout</a>
						<a href="profile.php">'.$_SESSION["username"].'</a>
					';
				}else{
					echo '
						<a href="#register" class="scroll">Register</a>
						<a href="#login" class="scroll">Login</a>
						<a href="userManual.php">User Manual</a>
					';
				}
				echo '
					<a ';
					if(strtolower($pageTitle) == "contact"){
						echo 'href="#contact" class="scroll this"';
					}else{
						echo 'href="contact.php"';
					}
					
					echo '>Contact</a>
					';
					if(strtolower($pageTitle) == "home"){
					
						echo '<a href="#about" class="scroll">About</a>';
						echo '<a href="#mainBody" class="srcoll this"';

					}else{
						echo '<a href="index.php#about">About</a>';
						echo '<a href="index.php"';
					}
					echo '>Home</a>
				';
			
			echo '</div>
		</nav>

	';

?>