<?php 

class FlightClass{
		
	private $classesAndPrice = 
	array(
		array("economy","300"),
		array("business","500"),
		array("first","1000")
	);

	public static function getPrice($className){
		$returnPrice;
		foreach ($classesAndPrice as $class) {
				
			if ( $class[0] == strtolower($className) ) {
				$returnPrice = $class[1];
			}
		}
		return $returnPrice;
	}

}

?>