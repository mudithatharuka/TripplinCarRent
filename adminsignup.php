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
		$name = '';
		$username = '';
		$nic = '';
		$phone = '';
		$email = '';
		$password = '';

		if(isset($_POST['signup'])){
			$name = $_POST['name'];
			$username = $_POST['username'];
			$nic = $_POST['nic'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$errors = array();

			//Checking required fields
			$req_fields =array('name', 'username', 'nic','phone','email','password');
			$errors = array_merge($errors, check_req_fields($req_fields));

			$query = "SELECT * FROM admin WHERE email = '{$email}' LIMIT 1";
			$result = mysqli_query($Connection, $query);

			if(mysqli_num_rows($result) == 1){
				$errors[] = 'This email address is already exists.';
			}

			if(empty($errors)){
				$name = mysqli_real_escape_string($Connection, $_POST['name']);
				$username = mysqli_real_escape_string($Connection, $_POST['username']);
				$nic = mysqli_real_escape_string($Connection, $_POST['nic']);
				$phone = mysqli_real_escape_string($Connection, $_POST['phone']);
				$email = mysqli_real_escape_string($Connection, $_POST['email']);
				$password = mysqli_real_escape_string($Connection, $_POST['password']);
				$hashed_password = sha1($password);

				$query = "INSERT INTO admin(username, name, nic, phone, email, password, is_deleted) VALUES ('{$username}', '{$name}', '{$nic}', '{$phone}', '{$email}', '{$hashed_password}', 0)";
				$result = mysqlI_query($Connection, $query);

				if($result){
					header('Location:adminlogin.php?signup=successful');
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

		<form action="adminsignup.php" method="post">
			<h2>Admin Signup</h2>
			<div class="bal"></div>
			<p>
				<label>Name:</label>
				<input type="text" name="name" <?php echo 'value="' .$name. '"'; ?> required>
			</p>
			<div class="bal"></div>
			<p>
				<label>Username:</label>
				<input type="text" name="username" <?php echo 'value="' .$username. '"'; ?> required>
			</p>
			<div class="bal"></div>
			<p>
				<label>Nic:</label>
				<input type="text" name="nic" <?php echo 'value="' .$nic. '"'; ?> required>
			</p>
			<div class="bal"></div>
			<p>
				<label>Phone:</label>
				<input type="number" name="phone" <?php echo 'value="' .$phone. '"'; ?> required>
			</p>
			<div class="bal"></div>
			<p>
				<label>Email:</label>
				<input type="email" name="email" <?php echo 'value="' .$email. '"'; ?> required>
			</p>
			<div class="bal"></div>
			<p>
				<label>Password:</label>
				<input type="password" name="password" required>
			</p>
			<div class="bal"></div>
			<p>
				<button name="signup">Sign Up <i class="fas fa-user-plus"></i></button>
				<a href="adminlogin.php" style="color: #1a1a1a; font-weight: bold;">Log In</a>
			</p>
			<div class="bal"></div>
		</form>
	</div><!-- Loginform -->
	<?php mysqli_close($Connection); ?>
</body>
</html>