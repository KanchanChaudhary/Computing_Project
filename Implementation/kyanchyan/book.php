<?php
require 'session.php';
// include 'flightClass.php';
include 'php/classes/class.booking.php';

if ( !$loggedIn ) {
	header("Location: index.php?msg=You must be logged in to book flights.");
	exit();
}	

if ( isset($_POST["btnBook"]) ) {

	$returnValue = "";

	if ( isset($_POST["toBookFlightId"]) 
		&& isset($_POST["flightClass"]) 
		&& isset($_POST["price"]) 
		&& isset($_POST["description"]) 
	) {

		$flightId = $_POST["toBookFlightId"];
		$flightClass = $_POST["flightClass"];
		$bookingPrice = $_POST["price"];
		$description = $_POST["description"];

		if ( strlen($flightId) > 0 
			 && strlen($flightClass) > 0 
			 && strlen($bookingPrice) > 0 
			 && strlen($description) > 0
			) {

			$bookingObj = new Booking();

			if( $bookingObj->bookFlight($flightId,$flightClass,$description,$bookingPrice) ){
				$returnValue = "Flight booked for ".$flightClass." class.";
			}else{
				$returnValue = "Flight may have already been booked! Please check your booking list!";
			}


		}else{
			$returnValue = "Fill up all required fields!";
		}
	}else{
		$returnValue = "Error";
	}

	$initParam = "from=".$_POST["from"]."&to=".$_POST["to"]."&departure=".$_POST["departure"];
	header("Location: search.php?".$initParam."&msg=".$returnValue);
}
?>