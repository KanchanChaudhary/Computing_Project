<?php 
require_once 'session.php';

if ( !$loggedIn ) {
	header("Location: index.php");
	exit();
}	

include 'php/classes/class.db.php';
class Profile extends Connection{

	public function __construct(){
		$this->connect();
	}

	public function updateProfile($username,$email,$phonenumber){
		$q = "UPDATE `customers` SET `username` = ?, email = ?,phonenumber = ? WHERE id = ?";
		$qs = $this->conn->prepare($q);
		$qs->bind_param("sssi",$username,$email,$phonenumber,$_SESSION["userId"]);
		$r = $qs->execute();
		$qs->close();
		return $r;
	}

	public function updatePassword($newPassword,$oldPassword){
		$q = "UPDATE `customers` SET `password` = ? WHERE id = ? AND password = ?";
		$qs = $this->conn->prepare($q);
		$qs->bind_param("sis",$newPassword,$_SESSION["userId"],$oldPassword);
		$r = $qs->execute();
		$qs->close();
		return $this->conn->affected_rows;
	}

}

$profile = new Profile();

if ( isset($_POST["btnUpdateProfile"]) ) {
	$username = $_POST["upUn"];
	$email = $_POST["upEm"];
	$phonenumber = $_POST["upPhone"];

	if ( strlen($username) > 6 ) {

		if ( $profile->updateProfile($username,$email,$phonenumber) ) {
			$_SESSION["username"] = $username;
			$_SESSION["email"] = $email;
			$_SESSION["phone"] = $phonenumber;
			header("Location: profile.php?msg=Profile updated!#upProfile");
		}else{
			header("Location: profile.php?msg=Failed to update profile!#upProfile");
		}
	}else{
		header("Location: profile.php?msg=New username must be atleast of 7 words.!#upProfile");
	}
	exit();

}

if ( isset($_POST["btnUpdatePassword"]) ) {
	if ( strlen($_POST["np"]) > 6 ) {
		$oldPassword = md5($_POST["op"]);
		$newPassword = md5($_POST["np"]);
		$affected_rows = $profile->updatePassword($newPassword,$oldPassword);
		if ( $affected_rows != 0 ) {
			header("Location: profile.php?msg=Password updated!#upPass");
		}else{
			header("Location: profile.php?msg=Invalid old password#upPass");
		}
	}else{
		header("Location: profile.php?msg=New password must be atleast of 7 words.#upPass");
	}
	exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<?php 
	$pageTitle = "My Profile";
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

		<div id="profileInfo" class="box">
			<!-- <h3 class="b">Informations</h3> -->
			
			<nav style="font-family: 'Lato',serif;">
			  <div class="nav nav-tabs" id="nav-tab" role="tablist">
			  	<a class="nav-item nav-link active" id="nav-id-tab" data-toggle="tab" href="#nav-id" role="tab" aria-controls="nav-id" aria-selected="true">User Id</a>
			    <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" >Username</a>
			    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Phone Number</a>
			    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Email</a>
			  </div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active tc" id="nav-id" role="tabpanel" aria-labelledby="nav-id-tab"><?php echo $_SESSION["userId"]; ?></div>
				<div class="tab-pane fade tc" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"><?php echo $_SESSION["username"]; ?></div>
				<div class="tab-pane fade tc" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"><?php echo $_SESSION["phone"]; ?></div>
				<div class="tab-pane fade tc" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab"><?php echo $_SESSION["email"]; ?></div>
			</div>
		</div>

		<div id="upProfile" class="box">
			<h5 class="mbtm b">Update Profile</h5>

			<form method="POST" action="profile.php">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" aria-describedby="unHelp" placeholder="Enter username..." name="upUn" value="<?php echo $_SESSION["username"]; ?>">
				</div>
				<div class="form-group">
					<label for="emailIn">Email</label>
					<input type="email" class="form-control" id="emailIn" aria-describedby="emailHelp" placeholder="Enter email..." name="upEm" value="<?php echo $_SESSION["email"]; ?>">
				</div>
				<div class="form-group">
					<label for="phoneNum">Phone Number</label>
					<input type="text" class="form-control" name="upPhone"  id="phoneNum" aria-describedby="phoneHelp" placeholder="Enter phone number..." value="<?php echo $_SESSION["phone"]; ?>">
					<small id="phoneHelp"class="form-text text-muted">We'll never share your phone with anyone else.</small>
				</div>

				<button type="submit" name="btnUpdateProfile" class="btn btn-primary float-sm-right">Update</button>
			</form>

		</div>

		<div class="box" id="upPass">
			<h5 class="mbtm b">Update Pasword</h5>

			<form method="POST" action="profile.php">
				<div class="form-group">
					<label for="op">Old Password</label>
					<input type="password" class="form-control" id="op" aria-describedby="unHelp" placeholder="Enter old password..." name="op">
				</div>
				<div class="form-group">
					<label for="np">New Password</label>
					<input type="password" class="form-control" id="np" aria-describedby="emailHelp" placeholder="Enter new password..." name="np">
				</div>

				<button type="submit" name="btnUpdatePassword" class="btn btn-primary float-sm-right">Update</button>
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
