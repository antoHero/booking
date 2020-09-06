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
			if(isset($_SESSION['error'])) {
				echo $_SESSION['error'];
				unset($_SESSION['error']);
			}
		?>
		<div class="row">
			
		
		
			<div class="col-md-6">
				<div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">List of parking lots</h5>
                        <ul class="list-group">
                        	<?php
								$qry = "SELECT * FROM lot";
								$result = mysqli_query($con, $qry);
								if(mysqli_num_rows($result) > 0) {
									while($row = mysqli_fetch_assoc($result)) {
										$id = $row['id'];
										session_start();
										$_SESSION['id'] = $id;
							?>
                            <li class="list-group-item"><h5 class="list-group-item-heading"><a href="reserve.php?lot=<?php echo $_SESSION['id'];?>"><?php echo $row['name'] ." ";?><span class="badge badge-secondary badge-pill"><?php echo "#".$row['cost'];?></span></a></h5>
                                <p class="list-group-item-text"><?php echo $row['description'];?></p>
                                <span></span>
                                <p class="mb-2 mr-2 badge badge-info">Capacity: <span class="badge badge-pill badge-light"><?php echo $row['capacity'];?> spaces</span></p>
                            </li>
                                <?php }
								} else {
									echo "string";
								}?>
						</ul>
                    </div>
                </div>
			</div>		
		
		</div>
	</div>
</body>
</html>
<script src="assets/js/bootstrap.min.js"></script>