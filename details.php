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
		<hr>
		<div class="row">
			
		
		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				$ref = htmlentities($_POST['refid'], ENT_QUOTES, 'UTF-8');
				if(!empty($ref)) {
					$result = mysqli_query($con, "SELECT * FROM transaction WHERE ref_id='$ref'");
					if(mysqli_num_rows($result) > 0) {
						while($row = mysqli_fetch_assoc($result)) {



		?>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-title">
			      		<h4 class="text-center">Ticket details!</h4>
			      		<hr>
			      	</div>
			      <div class="card-body">
			      	
			      	<p>Details for ORDER_REF: <?php echo $row['ref_id'];?></p>
			      	<p>Fullname: <?php echo $row['fullname'];?></p>
			        <p>Contact: <?php echo $row['contact'];?></p>
			        <p>Payment Method: <?php echo $row['payment'];?></p>
			        <p>Gender: <?php echo $row['gender'];?></p>
			        <p>Seats: <?php echo $row['seats'];?></p>
			        <p>Amount: <?php echo $row['cost'];?></p>
			        <button onclick="window.print()">Print</button>
			      </div>
			    </div>
			</div>		
		<?php }
					}
				}
			}?>
		</div>
	</div>
</body>
</html>
<script src="assets/js/bootstrap.min.js"></script>