<?php 
include 'class.db.php';

class Login extends Connection{

	public function __construct(){
		$this->connect();
	}

	public function login($un,$ps){

		$r = "";
		$query = "SELECT * FROM customers WHERE username = ? AND password = ?";
		$st = $this->conn->prepare($query);
		$st->bind_param("ss",$usn,$pss);
		$usn = $un;
		$pss = md5($ps);

		if ( $st->execute() ){
			$st->store_result();
			$st->bind_result($dbUid,$dbUn,$dbPs,$dbEmail,$dbPhoneNumber);

			if ( $st->num_rows < 1 ) {
				$r = "Invalid login details!";
			}else{
				if( $st->fetch() ){
					
					$_SESSION["userId"] = $dbUid; 
					$_SESSION["username"] = $dbUn;
					$_SESSION["email"] = $dbEmail;
					$_SESSION["phone"] = $dbPhoneNumber;
					$_SESSION["isAdmin"] = false;

					if ( strtolower($dbUn) == "administrator" ) {
						$_SESSION["isAdmin"] = true;
					}

					$r = "success";

				}
			}

		}else{
			$r = "An error occured while running the process.";
		}
		return $r;
	}

}

?>