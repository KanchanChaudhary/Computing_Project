<?php 
require_once 'session.php';


$isAdmin = false;

if ( isset($_SESSION["isAdmin"]) ) {
	$isAdmin = $_SESSION["isAdmin"];
}

if ( $isAdmin ) {
	include 'admin/addFlight.php';
}

?>

<!DOCTYPE html>
<html>
<head>
	<?php 
	$pageTitle = "Home";
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

		<?php 

			if ($isAdmin) {
				echo '

					<div id="adminPane" class="box tc">
						<h3 class="mbtm b"> Admin Panel </h3>
						<button class="btn btn-primary" data-toggle="modal" data-target="#addFlightModal">Add Flights</button>
						<button class="btn btn-primary" title="Confirm" data-toggle="modal" data-target="#confirmModal">Confirm Booking</button>
						<button class="btn btn-primary" title="Delete" data-toggle="modal" data-target="#deleteBookingModal">Delete Booking</button>
					</div>

				';
			}

			if ( $loggedIn ) {
				echo '
					<div id="adminPane" class="box tc">
						<h3 class="mbtm b"> Welcome, '.$_SESSION["username"].' </h3>
						<a href="profile.php" class="btn btn-primary">Update Profile</a>
						<a href="myBookings.php" class="btn btn-primary">View Bookings</a>
					</div>

				';
			}

		?>

		

		<div id="searchBooking" class="box">
			<h3 class="mbtm b">Search For Flight</h3>

				<div class="container" style="width: 100%;max-width: 100%;">
					<div class="row">
						<div class="booking-form" style="width: 98%;max-width: 98%;">
							<form action="search.php" method="GET">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<span class="form-label">Flying from</span>
											<input class="form-control" name="from" type="text" placeholder="City">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<span class="form-label">Flying to</span>
											<input class="form-control" name="to" type="text" placeholder="City">
										</div>
									</div>
									<div class="col">
										<div class="form-group">
											<span class="form-label">Departing</span>
											<input class="form-control" name="departure" type="datetime-local" required>
										</div>
									</div>
								</div>
								<div class="form-btn">
									<button class="submit-btn" name="btnLogin">Search</button>
								</div>
							</form>
						</div>
					</div>
				</div>

		</div>

		<div id="seats" class="box">
			<h3 class="mbtm b">Our Seat's classes</h3>

			<div class="card" style="width: 32%;float: left;margin-left: 1%;">
				<img src="img/economy.jpg" class="card-img-top" alt=" loading...">
				<div class="card-body">
					<h5 class="card-title">Economy Class</h5>
					<p class="card-text">The seats in this class is pretty cheap compared to others.</p>
					<a href="#" class="btn btn-success float-sm-right">~ £300</a>
				</div>
			</div>
			<div class="card" style="width: 32%;float: left;margin-left: 1%;">
				<img src="img/business.jpg" class="card-img-top" alt=" loading...">
				<div class="card-body">
					<h5 class="card-title">Business Class</h5>
					<p class="card-text">The seats are made for business people.</p>
					<a href="#" class="btn btn-success float-sm-right">~ £500</a>
				</div>
			</div>
			<div class="card" style="width: 32%;float: left;margin-left: 1%;">
				<img src="img/firstClass.jpg" class="card-img-top" alt=" loading...">
				<div class="card-body">
					<h5 class="card-title">First Class</h5>
					<p class="card-text">Very comfortable seats with comfortable price.</p>
					<a href="#" class="btn btn-success float-sm-right">~ £1,000</a>
				</div>
			</div>
		</div>

		<div id="about" class="box">
			<h3 class="mbtm b">About</h3>

			<p class="just">
				In the present situation people has become very modern and technology-dependent.  They want fast and easy method for communication as well as in working platforms. They don’t want to waste their valuable time in unnecessary things like standing on queue for a simple work. It is like wasting time for them. They want something which they can access from their home by using their mobiles phones, computers or by using internet services. They are using technology in their day to day activities like purchasing products, ordering goods, foods, air ticket booking, booking movie ticket etc. Taking people demand on consideration, the proposed project is to build "Online Air Ticketing" where people can purchase air ticket by sitting in their home without any stress.<br><br>
				Online Air Ticketing is a web application where people can book ticket for specific date as well as they can cancel ticket if emergency occurs. It also includes price of the ticket with ticket class like normal, business, economy etc. You can also see the time of flights of many airways companies.As you travel by air ticket, you can also search for the hotel around local areas using this web portal. You can easily book ticket a month before travelling. You can get cheapest flight for several places of country using this application. All you need to do is register first in application and you can book air ticket simply by browsing. Tickets are available for all the airports inside Nepal and it has 24 hours services.<br><br>
				Online Air Ticketing is very friendly application where users can easily interact with application without any knowledge and training. It is simply designed application with the motto of better performance. You don’t need to go to office for air ticket. You can see all the details of flight on web application.

			</p>
		</div>

		<?php 

			if (!$loggedIn) {
				echo '

					<div id="login" class="mbtm">
						<div id="booking">
							<div class="container" style="width: 100%;max-width: 100%;">
								<div class="row">
									<div class="booking-form" style="width: 98%;max-width: 98%;">
										<h3 class="mbtm b">Login</h3>
										<form action="login.php" method="POST">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<span class="form-label">Username</span>
														<input class="form-control" type="text" name="username" placeholder="Username...">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<span class="form-label">Password</span>
														<input class="form-control" type="password" name="password" placeholder="Password...">
													</div>
												</div>
											</div>
											<div class="form-btn">
												<button class="submit-btn" name="btnLogin">Login</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="register" class="mbtm">
						<div id="booking">
							<div class="container" style="width: 100%;max-width: 100%;">
								<div class="row">
									<div class="booking-form" style="width: 98%;max-width: 98%;">
										<h3 class="mbtm b">Register</h3>
										<form action="register.php" method="POST">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<span class="form-label">Username</span>
														<input class="form-control" type="text" name="username" placeholder="Username...">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<span class="form-label">Password</span>
														<input class="form-control" name="password" type="password" placeholder="Password...">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<span class="form-label">Email</span>
														<input class="form-control" type="email" name="email" placeholder="Email...">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<span class="form-label">Phone Number</span>
														<input class="form-control" type="text" name="phone" placeholder="Phone...">
													</div>
												</div>
											</div>
											<div class="form-btn">
												<button class="submit-btn" name="btnRegister">Register</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

				';
			}

		?>

	</div>

	<div id="floatingSocial">
		<a href="#"><img src="img/fb.png"></a>
		<a href="#"><img src="img/twitter.png"></a>
		<a href="#"><img src="img/instagram.png"></a>
		<a href="#mainBody" class="scroll" title="Scroll to top" style="display:block;margin-top:5px;"><img src="img/top.png"></a>
	</div>

	<!-- admin modals -->
	<!-- Modal -->
	<?php 

		if ($isAdmin) {
			echo '

				<div class="modal fade" style="z-index: 21000;" id="addFlightModal" tabindex="-1" role="dialog" aria-labelledby="addFlightModalTitle" aria-hidden="true">
				<form action="index.php" method="POST">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="addFlightModalTitle">Add Flight</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <div class="modal-body">
				        		
				        <div class="input-group input-group-sm mbtm">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Departure</span>
						  </div>
						  <input type="datetime-local" class="form-control" name="departure">
						</div>

						<div class="input-group input-group-sm mbtm">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Flying from...</span>
						  </div>
						  <input type="text" class="form-control" name="from">
						</div>		

						<div class="input-group input-group-sm mbtm">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Flying to...</span>
						  </div>
						  <input type="text" class="form-control" name="to">
						</div>

						<div class="input-group input-group-sm">
						  <div class="input-group-prepend">
						    <span class="input-group-text" id="inputGroup-sizing-sm">Flying agency name...</span>
						  </div>
						  <input type="text" class="form-control" name="agency" placeholder="Buddha air...">
						</div>		


				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" name="btnAddFlight" class="btn btn-primary">Add</button>
				      </div>
				    </div>
				  </div>
				  </form>
				</div>


				<div class="modal fade" style="z-index: 21000;" id="deleteBookingModal" tabindex="-1" role="dialog" aria-labelledby="deleteBookingModalTitle" aria-hidden="true">
					<form action="admin/handleBooking.php" method="POST">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="deleteBookingModalTitle">Delete Booking</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        		
					        <div class="input-group input-group-sm mbtm">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="inputGroup-sizing-sm">Booking Id</span>
							  </div>
							  <input type="number" class="form-control" name="delBookingId" required>
							</div>


					      </div>
					      <div class="modal-footer">
					        <button type="submit" name="btnDeleteBooking" class="btn btn-danger">Delete</button>
					      </div>
					    </div>
					  </div>
					  </form>
					</div>


				<div class="modal fade" style="z-index: 21000;" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalTitle" aria-hidden="true">
					<form action="admin/handleBooking.php" method="POST">
					  <div class="modal-dialog modal-dialog-centered" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="confirmModalTitle">Confirm Booking</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					        		
					        <div class="input-group input-group-sm mbtm">
							  <div class="input-group-prepend">
							    <span class="input-group-text" id="inputGroup-sizing-sm">Booking Id</span>
							  </div>
							  <input type="number" class="form-control" name="confirmBookingId" required>
							</div>


					      </div>
					      <div class="modal-footer">
					        <button type="submit" name="btnConfirmBooking" class="btn btn-success">Confirm</button>
					      </div>
					    </div>
					  </div>
					  </form>
					</div>

			';
		}

	?>

	<?php include 'php/beforeBodyTag.php'; ?>
</body>
</html>
