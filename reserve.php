<?php session_start();?>
<?php

	$con = mysqli_connect("127.0.0.1", "root", "secret", "booking");
	if(!$con):
		die('connection error (' .mysqli_connect_errno() . ') '. mysqli_connect_error());
	endif;

	// var_dump($con);
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
		<h3>Parking Lot</h3>
		<hr>
		<?php 
			if(isset($_SESSION['user_id']) && isset($_SESSION['name']) && $_SESSION['phone']){
				$name =  $_SESSION['name'];
				$phone = $_SESSION['phone'];
				$user = $_SESSION['user_id']; 
				// echo $user;

				
			} 
			$lot = $_GET['lot'];
			$qry = "SELECT * FROM lot WHERE id='$lot'";
			$result = mysqli_query($con, $qry);
			$row = mysqli_fetch_assoc($result);
			$name = $row['name'];

			$get = mysqli_query($con, "SELECT * FROM car_reservation WHERE lot_id = '$lot'");
        	$count = mysqli_num_rows($get);
		?>
		<?php 

			
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				$owner = htmlentities($_POST['fullname'], ENT_QUOTES, 'UTF-8');
				$contact = htmlentities($_POST['contact'], ENT_QUOTES, 'UTF-8');
				$vehicle = htmlentities($_POST['vehicle'], ENT_QUOTES, 'UTF-8');
				$plates = htmlentities($_POST['licence'], ENT_QUOTES, 'UTF-8');
				$event = htmlentities($_POST['event'], ENT_QUOTES, 'UTF-8');
				$cost = htmlentities($_POST['cost'], ENT_QUOTES, 'UTF-8');
				$lot = htmlentities($_POST['lot'], ENT_QUOTES, 'UTF-8');

				if(empty($owner)) {
					echo "Enter your fullname";
				}
				if(empty($contact)) {
					echo "Enter contact details";
				}
				if(empty($vehicle)) {
					echo "Incorrect vehicle type";
				}
				if(empty($plates)) {
					echo "Enter licence plates";
				}
				if(empty($event)) {
					echo "Event empty";
				}
				if(empty($cost)) {
					echo "Cost emo\pty";
				}
				if(empty($lot)) {
					echo "Lot id empty";
				}
				//check if there's available space in the parking lot
				if($count == $row['capacity']) {
					$_SESSION['error'] = "<div class='alert alert-danger'> Lot is filled up, try another!</div>";
					header('location: lots.php');
				} 

				else {
					$reserve = mysqli_query($con, "INSERT INTO car_reservation(vehicle_cat_id, licence_plate, car_owner, contact, lot_id, cost, event_id, user) VALUES('$vehicle', '$plates', '$owner', '$contact', '$lot', '$cost', '$event', '$user')");
					if($reserve) {

						$_SESSION['success'] = "<div class='alert alert-success'>You have successfully reserved a parking space. Print ticket!</div>";
						// echo "Successful";
						header('location: process_parking.php');
					} else {
						echo "Error!" . mysqli_error($con);
						// header('location: lots.php');
					}

				}
				 
			}

			
		
		?>
		<div class="row">
	
		
		
			<div class="col-md-6">
				<div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">List of parking lots</h5>
                        <ul class="list-group">
                        	<?php

                        		
								 
								
							?>
                            <li class="list-group-item"><h5 class="list-group-item-heading"><a href="reserve.php?lot=<?php echo $row['id'];?>"><?php echo $row['name'] ." ";?><span class="badge badge-secondary badge-pill"><?php echo "#".$row['cost'];?></span></a></h5>
                                <p class="list-group-item-text"><?php echo $row['description'];?></p>
                                <span></span>
                                
                                <p class="mb-2 mr-2 badge badge-info">Availability: <span class="badge badge-pill badge-light"><?php if($count != 10){echo $row['capacity'] - $count;} else{echo "occupied";}?></span></p>
                            </li>
						</ul>
                    </div>
                </div>
			</div>
			<div class="col-md-6">
				<div class="main-card mb-3 card">
					<div class="card-body">
		                <span>Fill the form below</span>
		                <p></p>
		                <p></p>
		                <br />
		                <form class="needs-validation" novalidate="" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		                    <div class="form-row">
		                        <div class="col-md-12 mb-3">
		                            <label for="validationCustom01">Full name</label>
		                            <input type="text" class="form-control" id="validationCustom01" placeholder="Full name" required="" name="fullname" value="<?php echo $name;?>">
		                            <div class="valid-feedback">
		                                Looks good!
		                            </div>
        		                    <input type="hidden" name="cost" value="<?php echo $row['cost'];?>">

		                        </div>
		                    </div>
		                        <div class="form-row">
		                        	<div class="col-md-12 mb-3">
			                            <label for="validationCustomUsername">Mobile No/Contact or Email Address</label>
			                            <div class="input-group">
			                                <div class="input-group-prepend">
			                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
			                                </div>
			                                <input type="text" class="form-control" id="validationCustomUsername"  aria-describedby="inputGroupPrepend" required="" name="contact" value="<?php echo $phone;?>">
			                                <div class="invalid-feedback">
			                                    Please provide a Mobile No/Contact or Email Address.
			                                </div>
			                            </div>
			                        </div>
		                        </div>
		                    <div class="form-row">
		                        <div class="col-md-6 mb-3">
		                            <label for="validationCustom03">Type of Vehicle</label>
		                            <select class="form-control" id="validationCustom03" name="vehicle" required=""> 
		                            	<option>--Choose--</option>
		                            	<option value="1">2 Wheeler</option>
		                            	<option value="2">4 Wheeler</option>
		                            </select>
		                            <div class="invalid-feedback">
		                                Please select type of vehicle.
		                            </div>
		                        </div>
		                        <div class="col-md-6 mb-3">
		                            <label for="validationCustom04">Licence Plate No</label>
		                            <input type="text" class="form-control" id="validationCustomUsername" placeholder="Licence Number" aria-describedby="inputGroupPrepend" required="" name="licence">
		                            <div class="invalid-feedback">
		                                Please provide a valid licence number.
		                            </div>
		                        </div>
		                    </div>
		                    <div class="form-row">
		                        <div class="col-md-12 mb-3">
		                            <label for="validationCustom03">Event</label>

		                            <select class="form-control" id="validationCustom03" name="event" required=""> 
		                            <?php
		                            	$fetch_events = mysqli_query($con, "SELECT * FROM events ORDER BY date DESC");
		                            	if(mysqli_num_rows($fetch_events) > 0) {
		                            		while($event = mysqli_fetch_assoc($fetch_events)) {

		                            		
		                            ?>
		                            	<option>--Choose--</option>
		                            	<option value="<?php echo $event['id'];?>"><?php echo $event['home'] ." vs ". $event['away'];?></option>
		                            <?php }}?>
		                            </select>
		                            <div class="invalid-feedback">
		                                Please select type of vehicle.
		                            </div>
		                        </div>
		                    </div>
		                    <input type="hidden" name="lot" value="<?php echo $lot;?>">
		                    <!-- <input type="hidden" name="event" value="<?php echo $event['id'];?>"> -->
		                    <button class="btn btn-primary" type="submit">Proceed</button>
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
		
		</div>
	</div>
</body>
</html>
<script src="assets/js/bootstrap.min.js"></script>