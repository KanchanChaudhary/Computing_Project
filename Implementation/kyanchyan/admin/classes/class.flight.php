<?php 
include 'php/classes/class.db.php';
include 'class.model.flight.php';

class FlightAction extends Connection{

	public function __construct(){
		$this->connect();
	}

	public function addFlight($flight){
		$rt = "";
		$query = "INSERT INTO `flight`(`departureDateTime`, `flyingFrom`, `flyingTo`, `flightAgencyName`) VALUES (?,?,?,?)";
		$st = $this->conn->prepare($query);
		$st->bind_param("ssss",$a,$b,$c,$d);

		$a = $flight->getDepartureTime();
		$b = $flight->getFlyingFrom();
		$c = $flight->getFlyingTo();
		$d = $flight->getFlyingAgencyName();

		if ( $st->execute() ){
			$rt = "ok";
		}else{
			$rt = "error";
		}
		return $rt;
	}

	public function getFlights($from,$to,$departure){
		$r = array();
		$query = "SELECT * FROM flight WHERE flyingFrom = ? AND flyingTo = ? AND departureDateTime >= ? ORDER BY departureDateTime DESC";
		$st = $this->conn->prepare($query);
		$st->bind_param("sss",$from,$to,$departure);

		if ( $st->execute() ){
			$st->store_result();
			$st->bind_result($dbId,$dbDeparture,$dbFrom,$dbTo,$dbAgency);

			if ( $st->num_rows < 1 ) {
				$r[0] = "empty";
			}else{
				$r[0] = "full";
				$r[1] = array();
				$count = 0; 
				while( $st->fetch() ){

					$flight = new Flight();
					$flight->setId($dbId);
					$flight->setDepartureTime($dbDeparture);
					$flight->setFlyingFrom($dbFrom);
					$flight->setFlyingTo($dbTo);
					$flight->setFlyingAgencyName($dbAgency);

					$r[1][$count] = $flight;

					$count++;
				}
			}

		}else{
			$rr[0] = "error";
		}
		return $r;
	}

}

?>