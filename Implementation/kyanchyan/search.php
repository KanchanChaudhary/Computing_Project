<?php 
require_once 'session.php';

$from;
$to;
$departure;
if ( isset($_GET["from"]) && isset($_GET["to"]) && isset($_GET["departure"]) ) {
	$from = $_GET["from"];
	$to = $_GET["to"];
	$departure = $_GET["departure"];
}else{
	header("Location: index.php?msg=Please enter all values to search");
	exit();
}

include 'admin/classes/class.flight.php';
$flightAction = new FlightAction();
$searchResults = $flightAction->getFlights($from,$to,$departure);


?>

<!DOCTYPE html>
<html>
<head>
	<?php 
	$pageTitle = "Search";
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
			<a href="index.php#searchBooking" class="btn btn-info mbtm float-sm-right"> &larr; Back to Search</a>
			<h3><b>Search Results</b></h3>
			<div><?php  
					echo '<b>From:</b> '.$from;
					echo ', <b>To:</b> '.$to;
					echo ', <b>Departure:</b> '.$departure;
				?></div>
			<br>

			<?php 

				if ( $searchResults[0] == "empty" ) {
					echo "<div class=\"searchBox box\">No flights found!</div>";
				}else{

					foreach ($searchResults[1] as $flight) {
						echo '
							<div class="searchBox box" id="'.$flight->getId().'">
								<div class="small" title="Flight id"><mark>#'.$flight->getId().'</mark></div>
								<div class="agency">'.$flight->getFlyingAgencyName().'</div>
								<div class="departure"><b>Departure: </b>'.$flight->getDepartureTime().'</div>
								<div class="from" title="Flying from">'.$flight->getFlyingFrom().'</div>
								<div class="midArrow">&rarr;</div>
								<div class="to mbtm" title="Flying to">'.$flight->getFlyingTo().'</div>
								<button class="bookBtn btn btn-success float-sm-right" data-toggle="modal" data-target="#bookFlightModal">Book</button>
							</div>
						';
					}

				}

			?>

		</div>

	</div>

	<script type="text/javascript">

		var bookBtns = document.getElementsByClassName('bookBtn');

		for (var i = bookBtns.length - 1; i >= 0; i--) {
			bookBtns[i].onclick = clikedBookBtn;
		}

		function clikedBookBtn() {
			document.getElementById('clickedFlightId').value = this.parentNode.id;
			document.getElementById('toBookFlightId').value = this.parentNode.id;
		}
		
	</script>

	<div class="modal fade" style="z-index: 21000;" id="bookFlightModal" tabindex="-1" role="dialog" aria-labelledby="bookFlightTitle" aria-hidden="true">
		<form action="book.php" method="POST">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="bookFlightTitle">Book Flight</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        		
		        <div class="input-group input-group-sm mbtm">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">Flight Id</span>
				  </div>
				  <input type="text" class="form-control" name="clickedFlightId" id="clickedFlightId" disabled>
				</div>

				<div class="input-group input-group-sm mbtm">
					<div class="input-group-prepend">
						<span class="input-group-text" id="inputGroup-sizing-sm">Booking Description</span>
					</div>
					<textarea class="form-control" name="description" rows="4"></textarea>
				</div>		

				<div class="input-group input-group-sm mbtm">
					<div class="input-group-prepend">
						<label class="input-group-text" for="flightClass">Flight Class</label>
					</div>
					<select class="custom-select" id="flightClass" name="flightClass">
						<option value="economy" selected>Economy</option>
						<option value="business">Business</option>
						<option value="first">First Class</option>
					</select>
				</div>

				<div class="input-group input-group-sm mbtm">
				  <div class="input-group-prepend">
				    <span class="input-group-text" id="inputGroup-sizing-sm">Price (£)</span>
				  </div>
				  <input type="text" class="form-control" id="bookingPrice" value="300" disabled>
				</div>

				<input type="hidden" name="from" value="<?php echo $from; ?>">
				<input type="hidden" name="to"  value="<?php echo $to; ?>">
				<input type="hidden" name="departure"  value="<?php echo $departure; ?>">
				<input type="hidden" name="toBookFlightId" id="toBookFlightId"> 
				<input type="hidden" name="price" id="price" value="300">

		      </div>
		      <div class="modal-footer">
		        <button type="submit" name="btnBook" class="btn btn-primary">Book Now</button>
		      </div>
		    </div>
		  </div>
		  </form>
		</div>

		<script type="text/javascript">
			document.getElementById('flightClass').onchange = function() {
				if (this.value == "economy") {
					document.getElementById('bookingPrice').value = "300";
					document.getElementById('price').value = "300";
				}
				if (this.value == "business") {
					document.getElementById('bookingPrice').value = "500";
					document.getElementById('price').value = "500";
				}
				if (this.value == "first") {
					document.getElementById('bookingPrice').value = "1000";
					document.getElementById('price').value = "1000";
				}
			}
		</script>

	<div id="floatingSocial">
		<a href="#"><img src="img/fb.png"></a>
		<a href="#"><img src="img/twitter.png"></a>
		<a href="#"><img src="img/instagram.png"></a>
		<a href="#mainBody" class="scroll" title="Scroll to top" style="display:block;margin-top:5px;"><img src="img/top.png"></a>
	</div>

	<?php include 'php/beforeBodyTag.php'; ?>
</body>
</html>
