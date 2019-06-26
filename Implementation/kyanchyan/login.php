<?php
require 'session.php';
include 'php/classes/class.login.php';

if ( $loggedIn ) {
	header("Location: index.php");
	exit();
}	

	if ( isset($_POST["btnLogin"]) ) {

		$returnValue = "";

		if ( isset($_POST["username"]) && isset($_POST["password"]) ) {

			$un = $_POST["username"];
			$ps = $_POST["password"];

			if ( strlen($un) > 6 && strlen($ps) > 6 ) {
				$loginUser = new Login();
				$returnValue = $loginUser->login($un,$ps);

				if ( $returnValue == "success" ) {
					$returnValue = "Logged in";
				}

			}else{
				$returnValue = "Invalid login details!";
			}

		}else{
			$returnValue = "Please enter username and password!";
		}

		header("Location: index.php?msg=".$returnValue."#login");
		exit();

	}

?>
