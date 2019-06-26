<?php 
require_once 'session.php';

include 'php/classes/class.booking.php';
include 'admin/classes/class.model.flight.php';
$bookingObj = new Booking();
$searchResults = $bookingObj->getMyBooking();
?>

<!DOCTYPE html>
<html>
<head>
	<?php 
	$pageTitle = "My Bookings";
	include 'php/headTag.php'; 
	?>
</head>
<body>
	<?php 
		$msg = "";
		if(isset($_GET["msg"])){
			$msg = $_GET["msg"];
			echo '<div id="msg">';
			echo htmlspecialchars($msg);
			echo '</div>';
		}  
	?>

	<div id="mainBody">
		
		<?php include 'php/nav.php'; ?>

		<div id="landing" class="box">
			<div><?php echo $pageTitle; ?></div>
		</div>

		<div id="contact" class="box">
			<h3><b>My Bookings</b></h3>
			<?php 

				if ( $searchResults[0] == "empty" ) {
					echo "<div class=\"searchBox box\">No bookings found!</div>";
				}

				if ( $searchResults[0] == "error" ) {
					echo "<div class=\"searchBox box\">An error was detected.</div>";
				}

				if( $searchResults[0] == "full" ){

					foreach ($searchResults[1] as $booking) {

						$flight = new Flight();
						$flight->setId($booking[1]);
						$flight->setDepartureTime($booking[6]);
						$flight->setFlyingFrom($booking[7]);
						$flight->setFlyingTo($booking[8]);
						$flight->setFlyingAgencyName($booking[9]);

						echo '
							<div class="searchBox box" id="'.$flight->getId().'">
								<div class="small" title="Flight id"><mark>#'.$flight->getId().'</mark></div>
								<div class="agency">'.$flight->getFlyingAgencyName().'</div>
								<div class="departure"><b>Departure: </b>'.$flight->getDepartureTime().'</div>
								<div class="from" title="Flying from">'.$flight->getFlyingFrom().'</div>
								<div class="midArrow">&rarr;</div>
								<div class="to mbtm" title="Flying to">'.$flight->getFlyingTo().'</div>
								<span class="bookedClass mbtm" title="Booked flight class">'.$booking[3].' Class</span> --
								<span class="bookedClass mbtm" title="Price">&pound;'.$booking[4].'</span>
								<div class="b mbtm" title="Booked flight class">Confirmed: '.$booking[5].'</div>
								<input class="bookBtn btn btn-success float-sm-right" value="Booked" disabled>
							</div>
						';
					}

				}

			?>

		</div>

	</div>

	<div id="floatingSocial">
		<a href="#"><img src="img/fb.png"></a>
		<a href="#"><img src="img/twitter.png"></a>
		<a href="#"><img src="img/instagram.png"></a>
		<a href="#mainBody" class="scroll" title="Scroll to top" style="display:block;margin-top:5px;"><img src="img/top.png"></a>
	</div>

	<?php include 'php/beforeBodyTag.php'; ?>
</body>
</html>
