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
		<br />
		<?php

		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			$fullname = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
			$user = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
			$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$type = $_POST['type'];
			$hashFormat = "$2y$10$";
		    $salt = 'iusesomecrazystrings22';
		    $hashF_and_salt = $hashFormat . $salt;
		    $password = crypt($password, $hashF_and_salt);
			$confirm = htmlentities($_POST['confirm_password'], ENT_QUOTES, 'UTF-8');
			$image = null;
			$phone = htmlentities($_POST['phone'], ENT_QUOTES, 'UTF-8');

			if(empty($fullname)) {
				echo "<div class='alert alert-danger'>Enter your fullname</div>";
			}
			elseif(empty($user)) {
				echo "<div class='alert alert-danger'>Select a username</div>";
			} 
			elseif(empty($email)) {
				echo "<div class='alert alert-danger'>Enter your email address</div>";
			}
			elseif(empty($password)) {
				echo "<div class='alert alert-danger'>Password field is empty</div>";
			}
			elseif(empty($confirm)) {
				echo "<div class='alert alert-danger'>Confirm your password</div>";
			}
			else {
				$sql = "SELECT * FROM users WHERE email='$email' AND username='$user'";
				$query = mysqli_query($con, $sql);
				if(mysqli_num_rows($query) > 0) {
					echo "<div class='alert alert-danger'>Email or Username already in use</div>";
				} 
				else {
					$qry = "INSERT INTO users(fullname, email, password, username, phone, image, user_type) 
					VALUES('$fullname', '$email', '$password', '$user', '$phone', '$image', '$type')";
					$result = mysqli_query($con, $qry);
					if($result) {
						echo "<div class='alert alert-success'>Sign up successful. Proceed to login</div>";
					} 
					else {
						echo "<div class='alert alert-danger'>Registration unsuccessful! </div>" . mysqli_error($con);
					}
				}

			}

		}

		?>
		<h3>STMS</h3>
		<hr>
		<div class="row">
			<div class="col-md-6 col-offset-6">
				<div class="main-card mb-3 card">
					<form class="needs-validation" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
	                    <div class="card-body"><h5 class="card-title">Sign into your account</h5>
	                        <div>
	                        	<div class="input-group">
	                                <div class="input-group-prepend"><span class="input-group-text">@</span></div>
	                                <input placeholder="Fullname" name="name" type="text" class="form-control">
                            	</div>
	                            <br>
	                            <div class="input-group">
	                                <div class="input-group-prepend"><span class="input-group-text">@</span></div>
	                                <input placeholder="username" name="username" type="text" class="form-control">
                            	</div>
	                            <br>
	                            <div class="input-group">
	                                <div class="input-group-prepend"><span class="input-group-text">@</span></div>
	                                <input placeholder="Email" name="email" type="text" class="form-control">
                            	</div>
	                            <br>
	                            <div class="input-group">
	                                <div class="input-group-prepend"><span class="input-group-text">@</span></div>
	                                <input placeholder="Phone Number" name="phone" type="text" class="form-control">
                            	</div>
	                            <br>
	                            <div class="input-group">
	                                <div class="input-group-prepend"><span class="input-group-text fa fa-key"></span></div>
	                                <input placeholder="Password" name="password" type="password" class="form-control">

	                            </div>
	                            <br>
	                            <div class="input-group">
	                                <div class="input-group-prepend"><span class="input-group-text fa fa-key"></span></div>
	                                <input placeholder="Confirm Password" name="confirm_password" type="password" class="form-control">
	                                <input type="hidden" name="type" value="1">
	                                
	                            </div>
	                            <br>
	                            <button class="btn btn-primary text-right" type="submit">Sign Up</button>
	                            <span>I already have an account. <a href="login.php">Log me in</a></span>
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