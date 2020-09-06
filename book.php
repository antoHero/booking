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
		<h3>Events</h3>
		<hr>
		<div class="row">
			
		
		<?php
		// global $event_id;
			
			if(isset($_GET['event'])) {
				session_start();

				$event_id = $_GET['event'];
				$_SESSION['id'] = $event_id;
			}

			if(isset($_SESSION['user_id']) && isset($_SESSION['name']) && $_SESSION['phone']){
				$name =  $_SESSION['name'];
				$phone = $_SESSION['phone'];
				$user = $_SESSION['user_id'];

				// echo $user;
				
			}
			
			$result = mysqli_query($con, "SELECT * FROM events WHERE id = '$event_id'");
			$row = mysqli_fetch_assoc($result);
			// $id = $row['id'];


		?>
		<?php

			$price = 500;
			$chars = "0123456789abcdefghijklmnopqrstuvwxyz";
        	$ref = 'ST-'.substr(str_shuffle($chars), 0, 10);
        	$event_id = $_GET['event'];
        	
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				$name = htmlentities($_POST['fullname'], ENT_QUOTES, 'UTF-8');
				$contact = htmlentities($_POST['contact'], ENT_QUOTES, 'UTF-8');
				$payment = htmlentities($_POST['payment'], ENT_QUOTES, 'UTF-8');
				$gender = htmlentities($_POST['gender'], ENT_QUOTES, 'UTF-8');
				$seats = htmlentities($_POST['seats'], ENT_QUOTES, 'UTF-8');
				$ref = htmlentities($_POST['refid'], ENT_QUOTES, 'UTF-8');
				$cost = htmlentities($_POST['cost'], ENT_QUOTES, 'UTF-8');
				$event = htmlentities($_POST['event'], ENT_QUOTES, 'UTF-8');

				
				$total = $seats * $price;
				if(empty($name)) {
					echo "Enter fullname";
				}
				if (empty($contact)) {
					echo "Enter Contact";
				}
				if(empty($payment)) {
					echo "Enter payment";
				}
				if(empty($gender)) {
					echo "selectgender";
				}
				if(empty(seats)) {
					echo "seats";
				}
				else {
						$sql = "INSERT INTO transaction(event_id, fullname, contact, payment, gender, seats, ref_id, cost, user) VALUES('".$event."', '".$name."', '".$contact."', '".$payment."', '".$gender."', '".$seats."', '".$ref."', '".$total."', '".$user."')";
						$result = mysqli_query($con, $sql);
						if($result) {
							$_SESSION['message'] = "<div class='alert alert-success'>Successful. Print below</div>";
							header('location: print.php');
						} else {
							echo "<div class='alert alert-danger'>Sorry we can't book your ticket now, try again!</div>" . mysqli_error($con) . mysqli_errno($con);
						}

				}
				 
			}
		?>
		<div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title">Checking out event:  <span class="mb-2 mr-2 badge badge-success"><?php echo $row['home'] ." vs ". $row['away'];?></span>|<?php echo " ";?><span class="mb-2 mr-2 badge badge-danger"> N500/seat</span></h5>
                <span>Fill the form below</span>
                <p></p>
                <span class="mb-2 mr-2 badge badge-danger">Your Reference ID is: <?php echo $ref;?></span>
                <p></p>
                <br />
                <form class="needs-validation" novalidate="" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                    <div class="form-row">
                        <div class="col-md-12 mb-3">
                            <label for="validationCustom01">Full name</label>
                            <input type="text" class="form-control" id="validationCustom01" required="" name="fullname" value=<?php echo $name;?>>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                    </div>
                        <div class="form-row">
                        	<div class="col-md-12 mb-3">
	                            <label for="validationCustomUsername">Mobile No/Contact or Email Address</label>
	                            <div class="input-group">
	                                <div class="input-group-prepend">
	                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
	                                </div>
	                                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required="" name="contact" value="<?php echo $phone;?>">
	                                <div class="invalid-feedback">
	                                    Please provide a Mobile No/Contact or Email Address.
	                                </div>
	                            </div>
	                        </div>
                        </div>
                    <div class="form-row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom03">Payment Method</label>
                            <select class="form-control" id="validationCustom03" name="payment" required=""> 
                            	<option>--Choose--</option>
                            	<option value="bank">Bank Transfer</option>
                            	<option value="epayment">E-payment</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a payment method.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom04">Gender</label>
                            <select class="form-control" id="validationCustom03" name="gender" required=""> 
                            	<option>--Choose--</option>
                            	<option value="male">Male</option>
                            	<option value="female">Female</option>
                            	<option value="other">Dont Specify</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select your gender.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationCustom05">No. of seats</label>
                            <input type="text" class="form-control" id="validationCustom05" placeholder="Seats" required="" name="seats">
                            <span>Min. seats is 5</span>
                            <div class="invalid-feedback">
                                Please enter number of seats.
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="refid" value="<?php echo $ref;?>">
                    <input type="hidden" name="cost">
                    <input type="hidden" name="event" value="<?php echo $event_id;?>">
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
	</div>
</body>
</html>
<script src="assets/js/bootstrap.min.js"></script>