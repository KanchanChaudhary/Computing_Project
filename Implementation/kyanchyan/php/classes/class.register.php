<?php 
include 'class.db.php';

class Register extends Connection{

	public function __construct(){
		$this->connect();
	}

	public function addUser($customerInfo){

		$isAccountAvailable = false;

		$c = "SELECT id FROM customers WHERE username = ?";
		$sc = $this->conn->prepare($c);
		$sc->bind_param("s",$customerInfo->getUsername());

		if ( $sc->execute() ) {
			$sc->store_result();

			if ( $sc->num_rows == 0 ) {
				$isAccountAvailable = true;
			}
		}

		if ( $isAccountAvailable ) {
			
			$query = "INSERT INTO `customers`(`username`, `password`, `email`,`phonenumber`) VALUES (?,?,?,?)";
			$st = $this->conn->prepare($query);
			$st->bind_param("ssss",$a,$b,$c,$d);

			$a = $customerInfo->getUsername();
			$b = $customerInfo->getPassword();
			$c = $customerInfo->getEmail();
			$d = $customerInfo->getPhoneNumber();

			if ( $st->execute() ){
				$rt = "ok";
			}else{
				$rt = "error";
			}

		}else{
			$rt = "taken";
		}
		return $rt;

	}

}

?>