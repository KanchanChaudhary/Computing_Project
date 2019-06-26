<?php 
require_once 'session.php';

?>

<!DOCTYPE html>
<html>
<head>
	<?php 
	$pageTitle = "Contact";
	include 'php/headTag.php'; 
	?>
</head>
<body>
	<?php 
		$msg = "";
		if(isset($_GET["msg"])){
			$msg = $_GET["msg"];
			echo '<div id="msg">';
			echo htmlspecialchars($msg);
			echo '</div>';
		}  
	?>

	<div id="mainBody">
		
		<?php include 'php/nav.php'; ?>

		<div id="landing" class="box">
			<div><?php echo $pageTitle; ?></div>
		</div>

		<div id="contact" class="box">
			<h3 class="mbtm b">Contact Us</h3>

			<form>
			  <div class="form-group row">
			    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="staticEmail" value="<?php if($loggedIn){echo $_SESSION["email"];}?>" placeholder="Email..">
			    </div>
			  </div>
			  <div class="form-group row">
			    <label for="inputPassword" class="col-sm-2 col-form-label">Message:</label>
			    <div class="col-sm-10">
			      <textarea class="form-control" id="inputPassword" placeholder="Message.." rows="4"></textarea>
			    </div>
			  </div>

			  <div class="custom-control custom-checkbox">
				  	<input type="checkbox" class="custom-control-input" id="customCheck1">
				  	<div style="margin-left: 17.5%;">
				  		<label class="custom-control-label" for="customCheck1">Email me for further messages</label>
				  	</div>
				</div>

			  <button type="submit" class="btn btn-primary float-sm-right">Send</button>
			</form>

		</div>

	</div>

	<div id="floatingSocial">
		<a href="#"><img src="img/fb.png"></a>
		<a href="#"><img src="img/twitter.png"></a>
		<a href="#"><img src="img/instagram.png"></a>
		<a href="#mainBody" class="scroll" title="Scroll to top" style="display:block;margin-top:5px;"><img src="img/top.png"></a>
	</div>

	<?php include 'php/beforeBodyTag.php'; ?>
</body>
</html>
