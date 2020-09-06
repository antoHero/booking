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
		<h3>Events</h3>
		<hr>
		<div class="row">
			
		
		<?php
			$qry = "SELECT * FROM events";
			$result = mysqli_query($con, $qry);
			if(mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_assoc($result)) {
					$id = $row['id'];
		?>
			<div class="col-md-4">
				<div class="card">
			      <div class="card-body">
			        <h5 class="card-title">Featured Match</h5>
			        <img src="images/epl.png" style="width: 100%; height:200px;" width="100%" class="card-img-top" alt="...">
			        <p class="card-text text-center"><?php echo $row['home']?> vs <?php echo $row['away'];?>.</p>
			        <p class="card-text text-center">Date: <?php echo $row['date']?>  Time: <?php echo $row['time'];?>.</p>
			        <p style="padding-left: 200px;"><a href="book.php?event=<?php echo $id;?>" class="btn btn-primary">Book</a></p>
			      </div>
			    </div>
			</div>		
		<?php }
			} else {
				echo "string";
			}?>
		</div>
	</div>
</body>
</html>
<script src="assets/js/bootstrap.min.js"></script>