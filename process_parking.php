<?php
	$con = mysqli_connect("127.0.0.1", "root", "secret", "booking");
	if(!$con):
		die('connection error (' .mysqli_connect_errno() . ') '. mysqli_connect_error());
	endif;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Stadium Booking System</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link href="./main.css" rel="stylesheet"></head>
	<style type="text/css">
		@media print {
			.navbar {
				display: none;
			}
		}
	</style>
</head>
<body>
	<?php include('includes/header.php');?>
	<div class="container">
		<h3>Events</h3>
		<?php
		if(isset($_SESSION['success'])) {
			echo $_SESSION['success'];
			unset($_SESSION['success']);
		} 
		?>
		<hr>
		<div class="row">
			
		
		
		<?php
		if(isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['phone'])) {
			$user = $_SESSION['user_id'];
			$phone = $_SESSION['phone'];
			$owner = $_SESSION['name'];
			echo $user;
		} 
		?>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-title">
			      		<h4 class="text-center">Parking details!</h4>
			      		<hr>
			      	</div>
			      <div class="card-body">
			      	<?php

			      		$result = mysqli_query($con, "SELECT * FROM car_reservation WHERE user='$user'");
			      		if(mysqli_num_rows($result) == 1) {
			      			$row = mysqli_fetch_assoc($result);
			      			$lot_id = $row['lot_id'];
			      			$event_id = $row['event_id'];
			      		}

			      	?>
			      	<p>Fullname: <?php echo $owner;?></p>
			        <p>Contact: <?php echo $phone;?></p>
			        <p>Vehicle Type: <?php if($row['vehicle_cat_id'] == 1) { echo "Two Wheeler";} else {echo "Four Wheeler";}?></p>
			        <p>Plates: <?php echo $row['licence_plate'];?></p>
			        <?php
			        	$query = mysqli_query($con, "SELECT * FROM events WHERE id='$event_id'");
			        	if(mysqli_num_rows($query) == 1) {
			        		$event = mysqli_fetch_assoc($query);
			        	}
			        ?>
			        <p>Event: <?php echo $event['home'] ." vs ". $event['away'];?></p>
			        <?php
			        	$query = mysqli_query($con, "SELECT * FROM lot WHERE id='$lot_id'");
			        	if(mysqli_num_rows($query) == 1) {
			        		$lot = mysqli_fetch_assoc($query);
			        	}
			        ?>
			        <p>Lot: <?php echo $lot['name'];?></p>
			        <p>Parking Cost: <?php echo $row['cost'];?></p>

			        
			        <button onclick="window.print()">Print</button>
			      </div>
			    </div>
			</div>	
		</div>
	</div>
</body>
</html>
<script src="assets/js/bootstrap.min.js"></script>