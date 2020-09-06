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
		
		<div class="row">
		

			<div class="col-sm-6">
				<?php
				if($_SERVER['REQUEST_METHOD'] == 'GET') {
					$refs = mysqli_real_escape_string($con, htmlspecialchars($_GET['ref']));
					// $refs = $_GET['ref'];

					$get_details = mysqli_query($con, "SELECT * FROM transaction WHERE ref_id='$refs'");
					if(mysqli_num_rows($get_details) == 1) {
						$ticket_details = mysqli_fetch_assoc($get_details);
				?>
				<p>Ref ID: <?php echo $ticket_details['ref_id'];?></p>
		      	<p>Fullname: <?php echo $ticket_details['fullname'];?></p>
		        <p>Contact: <?php echo $ticket_details['contact'];?></p>
		        <p>Payment method: <?php echo $ticket_details['payment'];?></p>
		        <?php
			        $event_id = $ticket_details['event_id'];
		        	$query = mysqli_query($con, "SELECT * FROM events WHERE id='$event_id'");
		        	if(mysqli_num_rows($query) == 1) {
		        		$event = mysqli_fetch_assoc($query);
		        	}
		        ?>
		        <p>Event: <?php echo $event['home'] ." vs ". $event['away'];?></p>
		        <p>Date: <?php echo $event['date'];?></p>
		        
		        <p>Seats: <?php echo $ticket_details['seats'];?></p>
		        <p>Cost: <?php echo $ticket_details['cost'];;?></p>
		        <hr>
		        <p>We will require your valid ID for verification.</p>
		        <p class="badge badge-warning">NOTE: Close the browser tab when finished.</p>
		        <p></p>
		        <button onclick="window.print()">Print</button>
				<?php } 
					else {
							$_SESSION['error'] =  "<div class='alert alert-danger'>Invalid Reference ID.</div>";
							header('location: print.php');
						}
					}
				?>
			</div>
	</div>
</body>
</html>
<script src="assets/js/bootstrap.min.js"></script>