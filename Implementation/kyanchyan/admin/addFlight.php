<?php
include 'classes/class.flight.php';

if ( $loggedIn && ($_SESSION["isAdmin"]) !== true ) {
	header("Location: index.php");
	exit();
}	

	if ( isset($_POST["btnAddFlight"]) ) {

		$returnValue = "";

		if ( 
			isset($_POST["departure"]) && isset($_POST["from"]) &&
			isset($_POST["to"]) && isset($_POST["agency"]) 

			) {

			$departure = $_POST["departure"];
			$from = $_POST["from"];
			$to = $_POST["to"];
			$agency = $_POST["agency"];

			if (

				strlen($departure) > 0 && strlen($from) > 0 && strlen($to) > 0 && strlen($agency) > 0

			) {
				$addFlightObj = new FlightAction();

				$flightObj = new Flight();
				$flightObj->setDepartureTime($departure);
				$flightObj->setFlyingFrom($from);
				$flightObj->setFlyingTo($to);
				$flightObj->setFlyingAgencyName($agency);

				$returnValue = $addFlightObj->addFlight($flightObj);

				if ( $returnValue == "ok" ) {
					$returnValue = "Flight added!";
				}
			}else{
				$returnValue = "Please fill up all fields to add flight!";
			}

		}

		header("Location: index.php?msg=".$returnValue);
		exit();

	}

?>
