<?php

	$con = mysqli_connect("127.0.0.1", "root", "secret", "booking");
	if(!$con):
		die('connection error (' .mysqli_connect_errno() . ') '. mysqli_connect_error());
	endif;

	

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Reserve Space</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:400" rel="stylesheet">

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>
	<?php include('includes/header.php');?>
	<div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<?php

					if($_SERVER['REQUEST_METHOD'] == 'GET') {
						$event = htmlentities($_POST['event'], ENT_QUOTES, 'UTF-8');
						$time = htmlentities($_POST['time'], ENT_QUOTES, 'UTF-8');

						if(!empty($event)) {
							$result = mysqli_query($con, "SELECT * FROM lot WHERE date");
						}
					}

				?>
				<div class="row">
					<div class="booking-form">
						<form method="GET" action="<?echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
							<div class="row no-margin">
								<h3>Find Parking Space</h3>
							</div>
							<br>
							<div class="row no-margin">
								<div class="col-md-9">
									<div class="row no-margin">
										<div class="col-md-6">
											<div class="form-group">
												<span class="form-label">Lot</span>
												<select class="form-control" name="event" required="">
													<option>--choose lot--</option>
													<?php
														$qry = mysqli_query($con, "SELECT * FROM lot");

														if(mysqli_num_rows($qry) > 0) {
															while($row = mysqli_fetch_assoc($qry)) {

													?>

													<option value="<?php echo $row['id'];?>"><?php echo $row['name'];?></option>

													<?php } }else echo "nothing found";?>
												</select>
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<span class="form-label">Date</span>
												<input class="form-control" name="date" type="date" required>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-btn">
										<button class="submit-btn" type="submit">Check availability</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>