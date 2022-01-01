<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>
<?php 

	if(isset($_SESSION['user_id'])){
		header("Location:index.php?logout=false");
	}
	if(isset($_SESSION['admin_id'])){
		header("Location:adminhome.php?logout=false");
	}

	//check for form submition
	if(isset($_POST['login'])){

		$errors = array();

		//check if the username and password have been entered
		if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ){
			$errors[]= 'Email is missing or invalid';
		}

		if(!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1 ){
			$errors[]= 'Username is missing or invalid';
		}

		if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ){
			$errors[]= 'Password is missing or invalid';
		}

		if(!isset($_POST['repassword']) || strlen(trim($_POST['repassword'])) < 1 ){
			$errors[]= 'Retyped password is missing or invalid';
		}

		//check if there are any errors
		if(empty($errors)){

			//save username and password into variables
			$email = mysqli_real_escape_string($Connection,$_POST['email']);
			$username = mysqli_real_escape_string($Connection,$_POST['username']);
			$password = mysqli_real_escape_string($Connection,$_POST['password']);
			$repassword = mysqli_real_escape_string($Connection,$_POST['repassword']);
			$hashed_password = sha1($password);
			$hashed_repassword = sha1($repassword);

			//prepare database query
			$query = "SELECT * FROM user WHERE username = '{$username}' AND email = '{$email}' AND password = '{$hashed_password}' AND password = '{$hashed_repassword}' AND is_deleted = 0 LIMIT 1";

			$result_set = mysqli_query($Connection, $query);

			if($result_set){
				//Query successful

				if(mysqli_num_rows($result_set) == 1){
					//valid user found
					$user = mysqli_fetch_assoc($result_set);
					$_SESSION['user_id'] = $user['id'];
					$_SESSION['first_name'] = $user['first_name'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['phone_number'] = $user['phone_number'];
					$_SESSION['phone_code'] = $user['phone_code'];
					$_SESSION['nic'] = $user['nic'];

					//update last login
					$query = "UPDATE user SET last_login = NOW() WHERE id = '{$_SESSION['user_id']}' LIMIT 1";
					$result = mysqli_query($Connection, $query);

					if(!$result){
						die("Update last login database query failed");
					}

					//redirect to home file
					header('Location: index.php');
				}else{
					//Username password or email invalid
					$errors = 'Invalid usename or email or password';
				}

			}else{
				$errors = 'Database query faild';
			}

		}	

	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Tripplin Car Rent</title>
</head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="css/lgn.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<body>

	<?php require_once('inc/hdr.php'); ?>


		<div class="Main">

			<div class="Blank">
				
			</div><!--Balank-->

			<div class="LogForm clearfix">
				<h1>LOGIN HERE</h1>
			</div><!--LogForm-->
				
				<form action="login.php" method="post">
					<div>

						<?php 

							if(isset($errors) && !empty($errors)){
								echo '<p class="error">Invalid Username Email or Password</p>';

							}
							if(isset($_SESSION['has_logged']) && $_SESSION['has_logged']=='no'){
								echo '<p class="error">You Must First Log In</p>';
								$_SESSION['has_logged']='';
							}
							if(isset($_GET['logout'])){
								echo '<p class="logout">Successfuly Logged Out</p>';

							}

						?>

						<h2 class="Topic">Username</h2>
						<input class="Username" type="text" placeholder="Username" name="username"><br>

						<h2 class="Topic">E-mail</h2>
						<input class="Email" type="mail" placeholder="E-mail Address" name="email"><br>

						
						<h2 class="Topic">Password</h2>
						<input class="Password" type="password" placeholder="Password" name="password">
						<h2></h2>
						<input class="RePassword" type="password" placeholder="Retype Password" name="repassword"><br>
					    
					</div>

						<button type="submit" name="login">LOG IN</button>

					<div class="Down">
						<ul>
							<li><a href="#">Fogotten password</a></li>
							<li><a href="reg.php">Dont have an account yet</a></li>
						</ul>
					</div>

				</form>

		</div><!--Main-->


	<?php require_once('inc/ftr.php'); ?>

</body>
</html>
<?php mysqli_close($Connection); ?>