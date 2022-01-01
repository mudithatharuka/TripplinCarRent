<?php require_once('inc/Connection.php'); ?>
<?php session_start(); ?>
<?php

	if(isset($_SESSION['user_id'])){
		header("Location:index.php?logout=false");
	}
	if(isset($_SESSION['admin_id'])){
		header("Location:adminhome.php?logout=false");
	}


	if(isset($_POST['register'])){
		
		$errors = array();
		$dualaccounterrors = array();
		$pw ='';
		$repw ='';

		//check if the username and password have been entered
		if(!isset($_POST['first_name']) || strlen(trim($_POST['first_name'])) < 1 ){
			$errors[]= 'first_name is missing or invalid';
		}
		if(!isset($_POST['last_name']) || strlen(trim($_POST['last_name'])) < 1 ){
			$errors[]= 'last_name is missing or invalid';
		}

		if(!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1 ){
			$errors[]= 'username is missing or invalid';
		}

		if(!isset($_POST['address1']) || strlen(trim($_POST['address1'])) < 1 ){
			$errors[]= 'address1 is missing or invalid';
		}

		if(!isset($_POST['phone_code']) || strlen(trim($_POST['phone_code'])) < 1 ){
			$errors[]= 'phone_code is missing or invalid';
		}

		if(!isset($_POST['phone']) || strlen(trim($_POST['phone'])) < 1 ){
			$errors[]= 'phone is missing or invalid';
		}else{
			$check_phone = mysqli_real_escape_string($Connection,$_POST['phone']);

			$check_query0 = "SELECT * FROM user WHERE phone_number = '{$check_phone}' LIMIT 1";

			$result_set0 = mysqli_query($Connection, $check_query0);

			if($result_set0){
				//Query successful

				if(mysqli_num_rows($result_set0) == 1){
					//valid user found
					$dualaccounterrors[] = 'There Is An Accout With This Phone Number Already';
				}

			}
		}

		if(!isset($_POST['nic']) || strlen(trim($_POST['nic'])) < 1 ){
			$errors[]= 'nic is missing or invalid';
		}else{
			$check_nic = mysqli_real_escape_string($Connection,$_POST['nic']);

			$check_query01 = "SELECT * FROM user WHERE nic = '{$check_nic}' LIMIT 1";

			$result_set01 = mysqli_query($Connection, $check_query01);

			if($result_set01){
				//Query successful

				if(mysqli_num_rows($result_set01) == 1){
					//valid user found
					$dualaccounterrors[] = 'There Is An Accout With This NIC Already';
				}

			}
		}

		if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ){
			$errors[]= 'Email is missing or invalid';
		}else{
			$check_email = mysqli_real_escape_string($Connection,$_POST['email']);

			$check_query1 = "SELECT * FROM user WHERE email = '{$check_email}' LIMIT 1";

			$result_set1 = mysqli_query($Connection, $check_query1);

			if($result_set1){
				//Query successful

				if(mysqli_num_rows($result_set1) == 1){
					//valid user found
					$dualaccounterrors[] = 'There Is An Accout With This Email Already';
				}

			}
		}

		if(!isset($_POST['gender'])){
			$errors[]= 'gender is missing or invalid';
		}

		if(!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ){
			$errors[]= 'Password is missing or invalid';
		}else{
			$pw = $_POST['password'];
		}

		if(!isset($_POST['repassword']) || strlen(trim($_POST['repassword'])) < 1 ){
			$errors[]= 'Retyped password is missing or invalid';
		}else{
			$repw = $_POST['repassword'];
		}
		if($pw != $repw){
			$errors[]= 'gender is missing or invalid';
		}

		


		if(empty($errors) && empty($dualaccounterrors)){

			$first_name = mysqli_real_escape_string($Connection,$_POST['first_name']);
			$last_name =  mysqli_real_escape_string($Connection,$_POST['last_name']);
			$username = mysqli_real_escape_string($Connection,$_POST['username']);
			$ad_line1 = mysqli_real_escape_string($Connection,$_POST['address1']);
			$ad_line2 = mysqli_real_escape_string($Connection,$_POST['address2']);
			$ad_line3 = mysqli_real_escape_string($Connection,$_POST['address3']);
			$phone_code = $_POST['phone_code'];
			$phone_number = mysqli_real_escape_string($Connection,$_POST['phone']);
			$nic = mysqli_real_escape_string($Connection,$_POST['nic']);
			$email = mysqli_real_escape_string($Connection,$_POST['email']);
			$gender = $_POST['gender'];
			$password = mysqli_real_escape_string($Connection,$_POST['password']);
			$re_password = mysqli_real_escape_string($Connection,$_POST['repassword']);

			$hashed_password = sha1($password);
			$hashed_repassword = sha1($re_password);
			$is_deleted = 0;

			$query ="INSERT INTO user(first_name, last_name, username, ad_line1, ad_line2, ad_line3, phone_code, phone_number, nic, email, gender, password, re_password, is_deleted) VALUES ('{$first_name}','{$last_name}','{$username}','{$ad_line1}','{$ad_line2}','{$ad_line3}','{$phone_code}','{$phone_number}','{$nic}','{$email}','{$gender}','{$hashed_password}','{$hashed_repassword}',{$is_deleted})";

			$result_set2 = mysqli_query($Connection, $query);

			if($result_set2){
				//Query successful


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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="css/reg.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>

	<?php require_once('inc/hdr.php'); ?>

		<div class="Main">

		<div class="Blank">
			
		</div>
			
			<div class="RegForm">
				<h1>REGISTRATION FORM</h1>
			</div><!--RegForm-->
				
				<form action="reg.php" method="post">

						<?php

						if(isset($errors) && !empty($errors)){
								echo '<p class="error">Invalid Inputs or Some fields are Missing</p>';
						}elseif(isset($dualaccounterrors) && !empty($dualaccounterrors)){
								echo '<p class="error">There Is An Accout With This Email,NIC or Phone Number Already</p>';
						}
						elseif(isset($errors) && empty($dualaccounterrors)){
								echo '<p class="noerror">Successfuly Registered. Please Login to Your Account</p>';
						}
						


						?>

						<h2 class="Topic">Name</h2>
						<input class="FirstName" type="text" placeholder="First Name" name="first_name">
						<input class="LastName" type="text" placeholder="Last Name" name="last_name"><br>
					

						<h2 class="Topic">Username</h2>
						<input class="Username" type="text" placeholder="Username" name="username"><br>

						<h2 class="Topic">Address</h2>
						<input class="Address1" type="text" placeholder="Line 1" name="address1"><br>
						<input class="Address2" type="text" placeholder="Line 2" name="address2"><br>
						<input class="Address2" type="text" placeholder="Line 3" name="address3"><br>

						<h2 class="Topic">Phone</h2>
						<select name="phone_code">
							<option>+91</option>
							<option>+92</option>
							<option>+93</option>
							<option>+94</option>
							<option>+95</option>
							<option>+96</option>
							<option>+97</option>
							<option>+98</option>
							<option>+99</option>
						</select>
						<input class="Phone" type="text" placeholder="Phone Number" name="phone"><br>

						<h2 class="Topic">NIC</h2>
						<input class="Nic" type="text" placeholder="National ID" name="nic"><br>

						<h2 class="Topic">E-mail</h2>
						<input class="Email" type="mail" placeholder="E-mail Address" name="email"><br>

						<h2 class="Topic">Gender</h2>
						<input class="radio rad1" type="radio" value="Male" name="gender"><h4 class="radio">Male</h4>
						<input class="radio" type="radio" value="Female" name="gender"><h4 class="radio">Female</h4>

						<div id="name">
						<h2 class="Topic">Password</h2>
						<input class="Password" type="password" placeholder="Password" name="password">
						<input class="RePassword" type="password" placeholder="Retype Password" name="repassword"><br>
					    </div>

						<button type="submit" name="register">REGISTER</button>

						<div class="Down">
							<ul>
								<li><a href="index.php">Already have an account</a></li>
							</ul>
						</div>

				</form>

				<div class="Blank">
			
				</div>

		</div><!--Main-->



	<?php require_once('inc/ftr.php'); ?>
	<?php mysqli_close($Connection); ?>

</body>
</html>