<?php 
include 'class.db.php';
	
class Booking extends Connection{

	public function __construct(){
		$this->connect();
	}

	public function bookFlight($flightId,$flightClassName,$bookingDescription,$price){
		$r = false;
		$q = "INSERT INTO `booking`(`customer_id`, `flight_id`, `description`, `flight_class`, `price`, `confirmed`) VALUES (?,?,?,?,?,?)";
		$qs = $this->conn->prepare($q);
		$qs->bind_param("iissis",$a,$b,$c,$d,$e,$f);
		
		$a = intval($_SESSION["userId"]);
		$b = $flightId;
		$c = $bookingDescription;
		$d = $flightClassName;
		$e = $price;
		$f = "false";

		$r = $qs->execute();
		$qs->close();
		return $r;
	}

	public function confirmBooking($bookingId){

		$q = "UPDATE `booking` SET `confirmed` = 'true' WHERE id = ?";
		$qs = $this->conn->prepare($q);
		$qs->bind_param("i",$bookingId);
		$r = $qs->execute();
		$qs->close();
		return $r;
	}

	public function deleteBooking($bookingId){
		$q = "DELETE FROM `booking` WHERE `id` = ?";
		$qs = $this->conn->prepare($q);
		$qs->bind_param("i",$bookingId);
		$r = $qs->execute();
		$qs->close();
		return $r;
	}


	//send email function
	public function mailUser($msg){
		$to      = $_SESSION["email"];
		$subject = 'Booking Confirmation';
		$message = $msg;

		mail($to, $subject, $message);
	}

	public function getBooking($where){

		$r = array();
		$query = "SELECT * FROM booking WHERE ".$where;
		$st = $this->conn->prepare($query);

		if ( $st->execute() ){
			$st->store_result();
			$st->bind_result($id,$customerId,$flightId,$description,$flightClass,$dbPrice,$confirmed);

			if ( $st->num_rows < 1 ) {
				$r[0] = "empty";
			}else{
				$r[1] = array();
				while( $st->fetch() ){
					array_push($r, 
						array($id,$customerId,$flightId,$description,$flightClass,$dbPrice,$confirmed) );
				}
			}

		}else{
			$r[0] = "error";
		}
		return $r;
	}

	public function getMyBooking(){

		$r = array();
		$query = "SELECT b.`id` AS `bookingid`,f.`id` AS `flightid`,description,flight_class,price,confirmed,departureDateTime,flyingFrom,flyingTo,flightAgencyName FROM `booking` b,`flight` f WHERE b.`flight_id` = f.`id` AND b.`customer_id` = ?";
		$st = $this->conn->prepare($query);
		$st->bind_param("i",$s);
		$s = $_SESSION["userId"];

		if ( $st->execute() ){
			$st->store_result();
			$st->bind_result($bid,$fid,$desc,$fclass,$price,$confirmed,$departureDateTime,$from,$to,$agency);

			if ( $st->num_rows < 1 ) {
				$r[0] = "empty";
			}else{
				$r[0] = "full";
				$r[1] = array();
				$count = 0; 
				while( $st->fetch() ){
					$r[1][$count] = 
					array($bid,$fid,$desc,$fclass,$price,$confirmed,$departureDateTime,$from,$to,$agency);

					$count++;
				}
			}

		}else{
			$r[0] = "error";
		}
		$st->close();
		return $r;
	}

}

?>