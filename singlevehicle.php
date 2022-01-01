<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>

<?php
	if(!isset($_GET['post_id'])){
		header('Location:index.php?post_id=false');
	}else{
		$booked = 'still_not';
		$has_booked = false;
		$post_id = $_GET['post_id'];
		$query = "SELECT * FROM rented_vehicles WHERE post_id = '{$_GET['post_id']}' LIMIT 1";
		$result = mysqli_query($Connection, $query);

		if($result){
			if(mysqli_num_rows($result) != 1){
				header("Location:index.php?post_id=error");
			}else{
				$data = mysqli_fetch_assoc($result);
				$kind = print_kind($data['kind_of_vehicle']);

						
						$first_name = '';
						$last_name = '';
						$pick = '';
						$return = '';

						if(isset($_POST['book'])){
							//Checking if the user logged in
							$_SESSION['has_logged'] ='';
							if(!isset($_SESSION['user_id'])){
								$_SESSION['has_logged'] = 'no';
								header('Location: login.php');
							}


							$first_name = $_POST['first_name'];
							$last_name = $_POST['last_name'];
							$pick = $_POST['pick'];
							$return = $_POST['return'];
							$post_id = $_POST['post_id'];
							$errors = array();

							//Checking required fields
							$req_fields =array('post_id','first_name', 'last_name','pick','return');
							$errors = array_merge($errors, check_req_fields($req_fields));

							if(empty($errors)){
								$errors = array_merge($errors, check_date_validity($pick, $return));
							}



							if(empty($errors)){
								$first_name = mysqli_real_escape_string($Connection, $_POST['first_name']);
								$last_name = mysqli_real_escape_string($Connection, $_POST['last_name']);
								$pick = mysqli_real_escape_string($Connection, $_POST['pick']);
								$return = mysqli_real_escape_string($Connection, $_POST['return']);
								$post_id = mysqli_real_escape_string($Connection, $_POST['post_id']);

								//Time zone is set to Asian time zone
								date_default_timezone_set("Asia/Kolkata");
								date_default_timezone_get();
								$booked_time = date("Y-m-d G:i:sa");

								$q = "INSERT INTO booked_vehicles(rented_post_id, rented_user_id, booked_user_id, booked_first_name, booked_last_name, brand_name, vehicle_name, price, profit, booked_time, picking_date, returning_date, status, seen, is_deleted_by_user) VALUES ('{$_GET['post_id']}', '{$data['user_id']}', '{$_SESSION['user_id']}', '{$first_name}', '{$last_name}', '{$data['brand_name']}', '{$data['vehical_name']}', '{$data['price']}', '{$data['profit']}', '{$booked_time}', '{$pick}', '{$return}', 'pending', 'no', 0)";
								$r = mysqli_query($Connection, $q);

								// echo $q;
								// die();

								if($r){
									$booked = 'true';
									$post_id = '';
								}else{
									echo "Booking database query failed";
									$booked = 'false';
								}
							}
						}


				$sql = "SELECT * FROM booked_vehicles WHERE rented_post_id = '{$_GET['post_id']}' AND ( status != 'deleted' AND status != 'returned' AND is_deleted_by_user != 1 )";
				$res = mysqli_query($Connection, $sql);
				// echo $sql;
				// die();

				if($res){
					if(mysqli_num_rows($res) != 0){
						$has_booked = true;
						$dat = mysqli_fetch_assoc($res);
					}else{
						$has_booked = false;

						
						
					}
				}else{
					echo "Getting bookings databasex query failed";
				}
			}
		}else{
			echo "Database query failed";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Tripplin Car Rent</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="css/shwrm.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

	<?php require_once('inc/hdr.php'); ?>

	<div class="Singlecontent">
		<div class="Advertiesment2">
			<img src="img/drive-toward-a-cure-banner-728x90.jpg">
			<img src="img/ICBC-728x90-business-matchmaking-banner-ad.gif">
		</div><!-- Advertiesment1 -->
	
	

	<div class="Singlevehicle">
		<h1>#<?php echo $data['post_id']; ?> <?php echo $data['brand_name']; ?> ~ <?php echo $data['vehical_name']; ?> <?php echo $data['mnf_year']; ?></h1>

			<?php

				if(isset($errors) && empty($errors) && $booked == 'true'){

					?><p class="success">Youy have successfully booked this vehicicle. <br>A notification will be sent to your Tripplin Car Rent account after the booking is confirmed by admins.</p><?php
				}else if($has_booked == true && isset($_SESSION['user_id'])){
					?><p class="error">This vehicle has a booking from <span style="color: #1a1a1a;"><?php echo $dat['picking_date']; ?></span> to <span style="color: #1a1a1a;"><?php echo $dat['returning_date']; ?></span>. Please look for another vehicle or contact an admin for more details.</p><?php
				}
			?>
			<div style="padding-left: 5%; color: red; font-family: sans-serif;">
			<?php if(!empty($errors)){
					display_errors($errors);
			}?>
			</div>

		<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['front_side_img']); ?>" alt="image1">
		<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['rear_side_img']); ?>" alt="image2">
		<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['side_view_img']); ?>" alt="image3">
		<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['f_compartment_img']); ?>" alt="image4">
		<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['r_compartment_img']); ?>" alt="image5">
		<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['d_compartment_img']); ?>" alt="image6">
		<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['e_compartment_img']); ?>" alt="image7">
		<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['extra_wheel_img']); ?>" alt="image8">

		<div class="empty"></div>
		<br><br>

		
		
			<p>
			<label>Owner:</label>
			<h4><?php echo $data['full_name']; ?></h4>
			</p>
			<div class="empty" style="background-color:#1a1a1a;"></div>

			<p>
			<label>Province:</label>
			<h4><?php echo $data['province']; ?></h4>
			</p>
			<div class="empty" style="background-color:#1a1a1a;"></div>

			<p>
			<label>District:</label>
			<h4><?php echo $data['district']; ?></h4>
			</p>
			<div class="empty" style="background-color:#1a1a1a;"></div>

			<p>
			<label>Vehicle name:</label>
			<h4><?php echo $data['vehical_name']; ?></h4>
			</p>
			<div class="empty" style="background-color:#1a1a1a;"></div>

			<p>
			<label>Vehicle brand:</label>
			<h4><?php echo $data['brand_name']; ?></h4>
			</p>
			<div class="empty" style="background-color:#1a1a1a;"></div>

			<p>
			<label>Kind:</label>
			<h4><?php echo $data['kind_of_vehicle']; ?></h4>
			</p>
			<div class="empty" style="background-color:#1a1a1a;"></div>

			<p>
			<label>Type:</label>
			<h4><?php echo $data['type_of_vehicle']; ?></h4>
			</p>
			<div class="empty" style="background-color:#1a1a1a;"></div>

			<p>
			<label>Year:</label>
			<h4><?php echo $data['mnf_year']; ?></h4>
			</p>
			<div class="empty" style="background-color:#1a1a1a;"></div>

			<p>
			<label>Condition:</label>
			<h4><?php echo $data['vehicle_condition']; ?></h4>
			</p>
			<div class="empty" style="background-color:#1a1a1a;"></div>

			<p>
			<label>Description:</label>
			<h4><?php echo $data['description']; ?></h4>
			</p>
			<div class="empty" style="background-color:#1a1a1a;"></div>

			

			<h3 class="bookpreh3"><?php echo $data['price']; ?> LKR</h3>
			<?php
				if(isset($_SESSION['user_id'])){
					if($has_booked == false && $data['user_id'] != $_SESSION['user_id']){
						?><button class="bookpre" name="bookpre" id="bookpre">BOOK</button><?php
					}
				}else{
					?><button class="bookpre" name="bookpre" id="bookpre">BOOK</button><?php
				}  
			?>

			<form action="singlevehicle.php?post_id=<?php echo($post_id); ?>" method="post">
				<input type="hidden" name="post_id" value="<?php echo($post_id); ?>">
				<div class="Details" id="details" style="display: none;">

					<p>
					<label>First name:</label>
					<input type="text" name="first_name" placeholder="First name" <?php echo 'value="' .$first_name. '"'; ?>>
					</p>
					<div class="empty" style="background-color:#1a1a1a;"></div>
					<p>
					<label>Last name:</label>
					<input type="text" name="last_name" placeholder="Last name" <?php echo 'value="' .$last_name. '"'; ?>>
					</p>
					<div class="empty" style="background-color:#1a1a1a;"></div>
					<p>
					<label>When will you pick the vehicle:</label>
					<input type="date" name="pick" placeholder="Picking date" <?php echo 'value="' .$pick. '"'; ?>>
					</p>
					<div class="empty" style="background-color:#1a1a1a;"></div>
					<p>
					<label>When will you return it back:</label>
					<input type="date" name="return" placeholder="Returning date" <?php echo 'value="' .$return. '"'; ?>>
					</p>
					<div class="empty" style="background-color:#1a1a1a;"></div>
					
				</div><!-- Details -->


				<p>
					<h3 class="bookh3" name="bookh3" id="bookh3" style="display: none;"><?php echo $data['price']; ?> LKR</h3>
					<button class="book" name="book" id="book" style="display: none;">BOOK</button>
				</p><div class="empty"></div>			
			</form>

			<script type="text/javascript">
				document.getElementById('bookpre').addEventListener('click',function(){
			
					document.querySelector('.Details').style.display = 'block';
					document.querySelector('.book').style.display = 'block';
					document.querySelector('.bookh3').style.display = 'block';
					document.querySelector('.bookpre').style.display = 'none';
					document.querySelector('.bookpreh3').style.display = 'none';
				});
			</script>


	</div><!-- Singlevehicle -->

	</div>	<!-- Singlecontent -->
	
	<div class="empty"></div>



	<?php require_once('inc/ftr.php');?>

	<?php mysqli_close($Connection); ?>
</body>
</html>