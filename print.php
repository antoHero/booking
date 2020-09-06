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
</head>
<body>
	<?php include('includes/header.php');?>
	<div class="container">
		<br />
		<h3>Printing Area</h3>
		<hr>
		<?php
		if(isset($_SESSION['message'])) {
			echo $_SESSION['message'];
			unset($_SESSION['message']);
		} 
		?>
		<?php
		if(isset($_SESSION['error'])) {
			echo $_SESSION['error'];
			unset($_SESSION['error']);
		} 
		?>
		
		<div class="row">
		<?php
		if(isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['phone'])) {
			$user = $_SESSION['user_id'];
			$phone = $_SESSION['phone'];
			$ticket_owner = $_SESSION['name'];
			
		 
		?>
			<div class="col-sm-6">
				<div class="card">
			      <div class="card-body">
			      	<?php

			      		$result = mysqli_query($con, "SELECT * FROM transaction WHERE user='$user'");
			      		if(mysqli_num_rows($result) == 1) {
			      			$row = mysqli_fetch_assoc($result);
			      			$seats = $row['seats'];
			      			$event_id = $row['event_id'];
			      			$ref = $row['ref_id'];
			      		}

			      	?>
			      	<div>Ensure to keep your REF ID safe.</div>
			      	<hr>
			      	<br />
			      	<p>Ref ID: <?php echo $ref;?></p>
			      	<p>Fullname: <?php echo $ticket_owner;?></p>
			        <p>Contact: <?php echo $phone;?></p>
			        <p>Payment method: <?php echo $row['payment'];?></p>
			        <?php
			        	$query = mysqli_query($con, "SELECT * FROM events WHERE id='$event_id'");
			        	if(mysqli_num_rows($query) == 1) {
			        		$event = mysqli_fetch_assoc($query);
			        	}
			        ?>
			        <p>Event: <?php echo $event['home'] ." vs ". $event['away'];?></p>
			        <p>Date: <?php echo $event['date'];?></p>
			        <?php
			        	$query = mysqli_query($con, "SELECT * FROM lot WHERE id='$lot_id'");
			        	if(mysqli_num_rows($query) == 1) {
			        		$lot = mysqli_fetch_assoc($query);
			        	}
			        ?>
			        <p>Seats: <?php echo $seats;?></p>
			        <p>Cost: <?php echo $row['cost'];?></p>

			        <br />
			        <p>We will require your valid ID for verification.</p>
			        <button onclick="window.print()">Print</button>
			      </div>
			    </div>
			</div>		
		<?php } else {


		?>
		<div class="col-sm-6">
			<div class="main-card mb-3 card">
	            <div class="card-body">
	                <h5 class="card-title">Print your ticket:  </h5>
	                <br />
	                <form class="needs-validation" novalidate="" method="GET" action="ticket.php">
	                    <div class="form-row">
	                        <div class="col-md-12 mb-3">
	                            <label for="validationCustom01">Reference ID</label>
	                            <input type="text" class="form-control" id="validationCustom01" required="" name="ref">
	                            <div class="valid-feedback">
	                                Looks good!
	                            </div>
	                        </div>
	                    </div>
	                        
	                    <button class="btn btn-primary" type="submit">Proceed</button>
	                    <p>Please keep your reference ID safe.</p>
	                </form>

	                <script>
	                    // Example starter JavaScript for disabling form submissions if there are invalid fields
	                    (function() {
	                        'use strict';
	                        window.addEventListener('load', function() {
	                            // Fetch all the forms we want to apply custom Bootstrap validation styles to
	                            var forms = document.getElementsByClassName('needs-validation');
	                            // Loop over them and prevent submission
	                            var validation = Array.prototype.filter.call(forms, function(form) {
	                                form.addEventListener('submit', function(event) {
	                                    if (form.checkValidity() === false) {
	                                        event.preventDefault();
	                                        event.stopPropagation();
	                                    }
	                                    form.classList.add('was-validated');
	                                }, false);
	                            });
	                        }, false);
	                    })();
	                </script>
	            </div>
	        </div>
		</div>
		<?php }?>
		
		</div>
		
	</div>
</body>
</html>
<script src="assets/js/bootstrap.min.js"></script>