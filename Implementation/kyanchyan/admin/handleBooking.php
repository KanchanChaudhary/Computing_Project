<?php 
require '../session.php';
include '../php/classes/class.booking.php';

if ( !$loggedIn ) {
	header("Location: ../index.php");
	exit();
}	
if ( !$_SESSION["isAdmin"] ) {
	header("Location: ../index.php?msg=Unauthorized access!");
	exit();
}	


$booking = new Booking();

if ( isset($_POST["btnDeleteBooking"]) ) {
	$delId = $_POST["delBookingId"];
	$msg = "";
	if ( $booking->deleteBooking($delId) ) {
		$msg = "Booking deleted";
	}else{
		$msg = "Error while deleting";
	}
	header("Location: ../index.php?msg=".$msg);
	exit();
}

if ( isset($_POST["btnConfirmBooking"]) ) {
	$bId = $_POST["confirmBookingId"];
	$msg = "";
	if ( $booking->confirmBooking($bId) ) {
		$msg = "Booking confirmed";
	}else{
		$msg = "Error while confirming";
	}
	header("Location: ../index.php?msg=".$msg);
	exit();
}

?>