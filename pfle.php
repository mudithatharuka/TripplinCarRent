<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php session_start(); ?>
<?php
	//Checking if the user logged in
	$_SESSION['has_logged'] ='';
	if(!isset($_SESSION['user_id'])){
		$_SESSION['has_logged'] = 'no';
		header('Location: login.php');

	}

	$currentp = '';
	if(isset($_POST['change'])){
		$currentp = $_POST['currentp'];
		$newp = $_POST['newp'];
		$retypep = $_POST['retypep'];
		$user_id = $_POST['user_id'];
		$errors = array();

		//Checking required fields
		$req_fields =array('user_id','currentp', 'newp','retypep');
		$errors = array_merge($errors, check_req_fields($req_fields));

		if(empty($errors)){
			$currentp = mysqli_real_escape_string($Connection, $_POST['currentp']);
			$newp = mysqli_real_escape_string($Connection, $_POST['newp']);
			$retypep = mysqli_real_escape_string($Connection, $_POST['retypep']);

			$query = "SELECT password FROM user WHERE id = '{$user_id}' LIMIT 1";
			$result = mysqli_query($Connection, $query);
			if($result){
				if(mysqli_num_rows($result) == 1){
					$row = mysqli_fetch_assoc($result);
					$cp = sha1($currentp);
					if($cp == $row['password']){
						if($newp == $retypep){
							$np = sha1($newp);
							$query = "UPDATE user SET password = '{$np}', re_password = '{$np}' WHERE id = '{$user_id}' LIMIT 1";
							$result = mysqli_query($Connection, $query);
							if($result){

							}else{
								echo "<b><h1>404</h1>Database sql query failed</b>";
								die();
							}
						}else{
							$errors[] = 'The new password and retyped password is different.';
						}
					}else{
						$errors[] = 'The current password you entered is invalid.';
					}
				}else{
					echo "<b><h1>404</h1>No such user</b>";
					die();
				}
			}else{
				echo "<b><h1>404</h1>Database query failed</b>";
				die();
			}
			
		}

	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Tripplin Car Rent</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="css/pfle.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
</head>
<body>

	<?php require_once('inc/hdr.php'); ?>

		<div class="Profile">

			<div class="Inside">

				<h1>Profile</h1>

				<div style="margin-left: 25%; color: red; font-family: sans-serif; margin-top: 30px;">
					<?php if(!empty($errors)){
							display_errors($errors);
						}?>
				</div>
				<?php
					if(isset($errors) && empty($errors)){
						?><h3 style="font-family: sans-serif; background-color: #35aa58; padding: 10px 35px; text-align: center; width: 75%; margin: 0 auto;">You have changed your password successfully</h3><?php
					}
				?>

					<div class="Information">
						<?php
							$qr = "SELECT * FROM user WHERE id = '{$_SESSION['user_id']}' LIMIT 1";
							$re = mysqli_query($Connection, $qr);
							if($re){
								if(mysqli_num_rows($re) == 1){
									$u_dat = mysqli_fetch_assoc($re);
								}else{
									echo "No user found";
								}
							}else{
								echo "Database query failed";
							}
						?>
						<h3 class="Topic">Name</h3><h3 class="Answer"><?php echo $u_dat['first_name']; ?> <?php echo $u_dat['last_name']; ?></h3><br>
						<h3 class="Topic">Userame</h3><h3 class="Answer"><?php echo $u_dat['username']; ?></h3><br>
						<h3 class="Topic">Address</h3><h3 class="Answer"><?php echo $u_dat['ad_line1']; ?> <?php echo $u_dat['ad_line2']; ?> <?php echo $u_dat['ad_line3']; ?></h3><br>
						<h3 class="Topic">Phone</h3><h3 class="Answer"><?php echo $u_dat['phone_code']; ?> <?php echo $u_dat['phone_number']; ?></h3><br>
						<h3 class="Topic">Nic</h3><h3 class="Answer"><?php echo $u_dat['nic']; ?></h3><br>
						<h3 class="Topic">Email</h3><h3 class="Answer"><?php echo $u_dat['email']; ?></h3><br>
						<h3 class="Topic">Gender</h3><h3 class="Answer"><?php echo $u_dat['gender']; ?></h3><br>
						<h3 class="Topic">Password</h3><h3 class="Answer">*********</h3><br>

						<h3 class="Topic"><a href="income.php?total_income=true" style="margin: 0; float: left;"><button style=" padding: 10px 30px; border-radius: 20px; background-color: orange; font-family: sans-serif; font-weight: bold; font-size: 16px; border: none;">Check Income <i class="fas fa-hand-holding-usd"></i></button></a></h3>
						<h3 class="Answer changepre" id="changepre" style="border: none;"><!-- <a href="#" style="float: left;"> --><button>Change Password</button><!-- </a> --></h3>

						<form action="pfle.php" method="post">
							<div class="Changepassword" style="display: none;">
								<p><input type="hidden" name="user_id" value="<?php echo($_SESSION['user_id']); ?>"></p>
								<p><h3 class="subtopic">Current Password:</h3><input type="text" name="currentp" <?php echo 'value="' .$currentp. '"'; ?>></p>
								<p><h3 class="subtopic">New Password:</h3><input type="password" name="newp"></p>
								<p><h3 class="subtopic">Retype Password:</h3><input type="password" name="retypep"></p>

								<button name="change" class="change">Change Password</button>
							</div><!-- Changepassword -->
						</form>

						<script type="text/javascript">
							document.getElementById('changepre').addEventListener('click',function(){
								document.querySelector('.Changepassword').style.display = 'block';
								document.querySelector('.changepre').style.display = 'none';	
							});
						</script>

					</div><!--Information-->

					<div class="Usage">
						
						<!-- <img src="img/White-Lamborghini-wallpapers-HD-for-desktop.jpg" alt="Immage"> -->

						<h2>Booked Vehicles <i class="far fa-handshake"></i></h2>

						<div class="Info clearfix">
							<?php
								$query = "SELECT * FROM booked_vehicles WHERE booked_user_id = '{$_SESSION['user_id']}' AND is_deleted_by_user != 1 /*AND status != 'deleted'*/";
								$result = mysqli_query($Connection, $query);

							if($result){
								if(mysqli_num_rows($result) > 0){
									while ($data = mysqli_fetch_assoc($result)) {

										$sub_query = "SELECT * FROM rented_vehicles WHERE post_id = '{$data['rented_post_id']}' LIMIT 1";
										$sub_result = mysqli_query($Connection, $sub_query);

										// echo $sub_query;
										// die();

										if($sub_result){
											if(mysqli_num_rows($sub_result) == 1){
												$sub_data = mysqli_fetch_assoc($sub_result);
												$kind = print_kind($sub_data['kind_of_vehicle']);
												?><div class="Item">
													<img src="web_img/<?php echo($kind); ?>/<?php echo($sub_data['kind_of_vehicle']); ?>/<?php echo($sub_data['post_id']); ?>/<?php echo($sub_data['front_side_img']); ?>" alt="Vehicle photo here" style="height: 250px;">
													<h3><?php echo $data['vehicle_name']; ?></h3>
													<p style="border-bottom: 1px solid #808080; padding-bottom: 10px; color: yellow; text-align: center; font-size: 20px;"><?php echo $sub_data['price']; ?> /= per day</p>
													<h5 style="padding: 10px 0 0 0; font-weight: bold; color: #808080; ">@ <?php echo $data['booked_time']; ?></h5>

													<h1 style="float: left; border:none; margin: 0;">|</h1>
													<div class="datedata" style="float: left; padding-top: 5px;">
														<h5 style="font-family: sans-serif; font-weight: bold;">Picking date:</h5>
														<p style=" font-weight: bold; color: orange; padding-bottom: 20px;"><?php echo $data['picking_date']; ?></p>
													</div>


													<div class="datedata" style="float: right; padding-top: 5px;">
														<h5 style="font-family: sans-serif; font-weight: bold;">Returning date:</h5>
														<p style=" font-weight: bold; color: #00bc8c; padding-bottom: 20px;"><?php echo $data['returning_date']; ?></p>
													</div>
													<h1 style="float: right; text-align: right; border:none; margin: 0;">|</h1>
													
													<?php
													$bgc = status($data['status']);
														switch ($data['status']) {
															case 'pending':
																?><h3 class="h3" style="padding-left: 15px; padding-right: 15px; background-color: <?php echo $bgc; ?>">Your booking is pending.</h3><?php
																break;
															case 'confirmed':
																?><h3 class="h3" style="padding-left: 15px; padding-right: 15px; background-color: <?php echo $bgc; ?>">Your booking has been confirmed.</h3><?php
																break;
															case 'deleted':
																?><h3 class="h3" style="padding-left: 15px; padding-right: 15px; background-color: <?php echo $bgc; ?>">Your booking has been deleted by admins.</h3><?php
																break;
															case 'returned':
																?><h3 class="h3" style="padding-left: 15px; padding-right: 15px; background-color: <?php echo $bgc; ?>">Your have returned the vehicle.</h3><?php
																break;														
														}
													?>

													<div class="empty"></div>
													<div class="but">
														<a href="singlevehicle.php?post_id=<?php echo($sub_data['post_id']); ?>"><button style="background-color: orange;">Check</button></a>
														<?php
															if($data['status'] == 'pending'){
																?><a href="delete.php?post_id=<?php echo($data['post_id']); ?>&category=booked" onclick="return confirm('Are you sure you want to cancel this booking?');"><button style="background-color: red;">Cancel</button></a><?php
															}
														?>
													</div>				
												</div><!-- car --><?php

											}else{
												echo "Something went wrong";
											}
										}else{
											echo "Database sub query failed";
										}

									}
								}else{
									echo "<h3 style=\"padding: 10px 0 20px 0; text-align: center; color: #aaa; font-family: sans-serif;\">No booked vehicles found</h3>";
								}
							}else{
								echo "Database query failed";
							}
							?>

	
						</div><!--Info-->

						<h2>Rented Vehicles <i class="far fa-window-restore"></i></h2>

						<div class="Info clearfix">
						<?php  
							$query = "SELECT * FROM rented_vehicles WHERE user_id = '{$_SESSION['user_id']}' AND is_deleted != 1";
							$result = mysqli_query($Connection, $query);

							if($result){
								if(mysqli_num_rows($result) > 0){
									while ($data = mysqli_fetch_assoc($result)) {
										$kind = print_kind($data['kind_of_vehicle']);

										?><div class="Item">
											<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['front_side_img']); ?>" alt="Vehicle photo here" style="height: 250px;">
											<h3><?php echo $data['vehical_name']; ?></h3>
											<p style="text-align: center;"><?php echo $data['mnf_year']; ?></p>
											<p style="text-align: center;"><?php echo $data['province']; ?> Province</p>
											<p style="text-align: center;"><?php echo $data['district']; ?> District</p>
											<h3 style="color: yellow"><?php echo $data['price']; ?> /=<br><span style="color: #808080;">LKR per day</span></h3>
											<div class="but">
												<a href="income.php?post_id=<?php echo($data['post_id']); ?>"><button style="background-color: green;">Income</button></a>
												<a href="singlevehicle.php?post_id=<?php echo($data['post_id']); ?>"><button style="background-color: #00bc8c;">Look</button></a>
												<?php
													$sql = "SELECT * FROM booked_vehicles WHERE rented_post_id = '{$data['post_id']}' AND ( status != 'deleted' AND is_deleted_by_user != 1 )";
													$res = mysqli_query($Connection, $sql);

													if($res){
														if(mysqli_num_rows($res) == 0){
															?><a href="delete.php?post_id=<?php echo($data['post_id']); ?>&category=rented" onclick="return confirm('Are you sure you want to delete this renting?');"><button style="background-color: red;">Delete</button></a><?php
														}
													}else{
														echo "Getting bookings databasex query failed";
													}
												?>
												
											</div>		
										</div><!-- car --><?php
									}
								}else{
									echo "<h3 style=\"padding: 10px 0 20px 0; text-align: center; color: #aaa; font-family: sans-serif;\">No rented vehicles found</h3>";
								}
							}else{
								echo "Database query failed";
							}
						?>

						

						</div><!--Info-->

						

					</div><!--Usage-->


			</div><!--Inside-->

		</div><!--Profile-->


	<?php require_once('inc/ftr.php'); ?>
	<?php mysqli_close($Connection); ?>
</body>
</html>