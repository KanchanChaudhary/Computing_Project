<?php
require 'session.php';
include 'php/classes/class.model.customer.php';
include 'php/classes/class.register.php';

if ( $loggedIn ) {
	header("Location: index.php");
	exit();
}	
	
	if ( isset($_POST["btnRegister"]) ) {

		$returnValue = "";

		if ( isset($_POST["username"]) && isset($_POST["password"]) &&
			 isset($_POST["phone"]) && isset($_POST["email"])
			) {

			$phone = $_POST["phone"];
			$emailAddress = $_POST["email"];
			$un = $_POST["username"];
			$ps = $_POST["password"];

			if ( strlen($phone) > 0 
				 && strlen($emailAddress) > 0 
				 && strlen($un) > 0 
				 && strlen($ps) > 0
				) {
				
				if ( 
					 strlen($un) > 6 && strlen($ps) > 6
					) {

						$newCustomer = new Customer;

						$newCustomer->setEmail($emailAddress);
						$newCustomer->setPhoneNumber($phone);
						$newCustomer->setUsername($un);
						$newCustomer->setPassword(md5($ps));

						$addMember = new Register();
						$returnValue = $addMember->addUser($newCustomer);

						if ( $returnValue == "ok" ) {
							$returnValue = "Registration successful.";
						}
						if ( $returnValue == "error" ) {
							$returnValue = "Registration error.";
						}
						if ( $returnValue == "taken" ) {
							$returnValue = "Username already taken.";
						}

				}else{
					$returnValue = "Username and password must be at least 5 letters!";
				}

			}else{
				$returnValue = "Please enter in all the fields.";
			}

		}else{
			$returnValue = "Error! No Post values.";
		}

		header("Location: index.php?msg=".$returnValue."#register");
		exit();

	}

?>
