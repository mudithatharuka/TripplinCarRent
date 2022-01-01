<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php session_start(); ?>

<?php
	if(isset($_SESSION['admin_id'])){
		header("Location:adminhome.php?logout=false");
	}
	else if(isset($_SESSION['user_id'])){
		header("Location:index.php?logout=false");
	}else{
		$email = '';
		$password = '';

		if(isset($_POST['login'])){
			$email = $_POST['email'];
			$password = $_POST['password'];
			$errors = array();

			//Checking required fields
			$req_fields =array('email','password');
			$errors = array_merge($errors, check_req_fields($req_fields));

			if(empty($errors)){
				$email = mysqli_real_escape_string($Connection, $_POST['email']);
				$password = mysqli_real_escape_string($Connection, $_POST['password']);
				$hashed_password = sha1($password);

				$query = "SELECT * FROM admin WHERE email = '{$email}' AND password = '{$hashed_password}' LIMIT 1";
				$result = mysqli_query($Connection, $query);

				if($result){
					if(mysqli_num_rows($result) == 1){
						$admin = mysqli_fetch_assoc($result);
						$_SESSION['admin_id'] = $admin['id'];
						$_SESSION['username'] = $admin['username'];

						//update last login
						$query = "UPDATE admin SET last_login = NOW() WHERE id = '{$_SESSION['admin_id']}' LIMIT 1";
						$result = mysqli_query($Connection, $query);

						if(!$result){
							die("Update last login database query failed");
						}

						header('Location:adminhome.php');
					}else{
						$errors[] = 'Invalid email or password';
					}
				}else{
					echo "<b><h1>404</h1>Database query failed</b>";
					die();
				}	
			}
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Admin - Tripplin Car Rent</title>
	<link rel="stylesheet" type="text/css" href="css/adminlogin.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

	<div class="Loginform">
		<h1>Tripplin Car Rent</h1>

		<div style="color: red; padding-bottom: 30px;">
			<?php
				if(!empty($errors)){
					display_errors($errors);
				}
			?>
		</div>

		<form action="adminlogin.php" method="post">
			<h2>Admin Login</h2>
			<div class="bal"></div>
			<p>
				<label>Email:</label>
				<input type="email" name="email" <?php echo 'value="' .$email. '"'; ?>>
			</p>
			<div class="bal"></div>
			<p>
				<label>Password:</label>
				<input type="password" name="password">
			</p>
			<div class="bal"></div>
			<p>
				<button name="login">Log In <i class="fas fa-sign-in-alt"></i></button>
				<a href="adminsignup.php" style="color: #1a1a1a; font-weight: bold;">Sign Up</a>
			</p>
			<div class="bal"></div>
		</form>
	</div><!-- Loginform -->
	<?php mysqli_close($Connection); ?>
</body>
</html>