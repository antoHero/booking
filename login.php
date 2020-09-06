<?php

	$con = mysqli_connect("127.0.0.1", "root", "secret", "booking");
	if(!$con):
		die('connection error (' .mysqli_connect_errno() . ') '. mysqli_connect_error());
	endif;

	// var_dump($con);
?>
<?php session_start();?>
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
		<?php

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$password = $_POST['password'];

			if(empty($username)) {
				echo "<div class='alert alert-danger'>Email is empty</div>";
			}

			if(empty($password)) {
				echo "<div class='alert alert-danger'>Password is empty</div>";
			}

			//if no errors, check if user exists
			$query = mysqli_query($con, "SELECT * FROM users WHERE email='$email'");
			//if user is found
			if(mysqli_num_rows($query) == 1) {
				//store user details in array
				$row = mysqli_fetch_assoc($query);
				// echo $row['password'];
				//verify password, create sessions then log in

				if(password_verify($password, $row['password'])) 
			        if(!session_id())
			        session_start();
			        $_SESSION['user_id'] = $row['id'];
			        $_SESSION['type'] = $row['user_type'];
			        $_SESSION['user'] = $row['username'];
			        $_SESSION['phone'] = $row['phone'];
			        $_SESSION['name'] = $row['fullname'];
			        header('location: index.php');
			        exit();

			} else {
				echo "<div class='alert alert-danger'>Username/Password combination is incorrect!</div>";
			}

		}

		?>
		<h3>STMS</h3>
		<hr>
		<div class="row">
			<div class="col-md-6 col-offset-6">
				<div class="main-card mb-3 card">
					<form class="needs-validation" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	                    <div class="card-body"><h5 class="card-title">Log into your account</h5>
	                        <div>
	                            <div class="input-group">
	                                <div class="input-group-prepend"><span class="input-group-text">@</span></div>
	                                <input placeholder="Email" name="email" type="text" class="form-control"></div>
	                            <br>
	                            <div class="input-group">
	                                <div class="input-group-prepend"><span class="input-group-text fa fa-key"></span></div>
	                                <input placeholder="Password" name="password" type="password" class="form-control"></div>
	                            <br>
	                            <button class="btn btn-primary text-right" type="submit">Login</button>
	                             <span>I don't have an account. <a href="signup.php">Register</a></span>
	                        </div>
	                    </div>
					</form>
                </div>
			</div>	
		</div>
	</div>
</body>
</html>
<script src="assets/js/bootstrap.min.js"></script>