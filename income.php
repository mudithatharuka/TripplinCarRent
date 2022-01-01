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

	$booked_list = '';
	$notif = '';

	
	if(isset($_GET['total_income']) && $_GET['total_income'] == 'true'){
		

		$query = "SELECT * FROM booked_vehicles WHERE rented_user_id = '{$_SESSION['user_id']}' ORDER BY post_id DESC";
		$result = mysqli_query($Connection, $query);

		// echo $query;
		// die();
		$_SESSION['total_income'] = 0;

		if($result){
			if(mysqli_num_rows($result) > 0){
				$bookking = true;
				$notifications = false;
				while($data = mysqli_fetch_assoc($result)){
					if($data['is_deleted_by_user'] == 1){
						$rowcolor = '#355C7D';
					}else{
						$rowcolor = status($data['status']);
					}

					$income =  ($data['price']-$data['profit']);
					if($data['is_deleted_by_user'] == 0 && $data['status'] != 'deleted'){
						$_SESSION['total_income'] = $_SESSION['total_income'] + $income;
					}

					$booked_list.="<tr>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['post_id']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_user_id']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_first_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_last_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['brand_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['vehicle_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_time']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['price']} <i class=\"fas fa-money-check-alt\"></i></td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['profit']} <i class=\"fas fa-funnel-dollar\"></i></td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$income} <i class=\"fas fa-hand-holding-usd\"></i></td>";
					$booked_list.="</tr>";

				}
			}else{
				$bookking = false;
				$notifications = false;
			}
		}else{
			echo "Database query failed";
		}

	}else if(isset($_GET['post_id'])){
		$query = "SELECT * FROM booked_vehicles WHERE rented_post_id = '{$_GET['post_id']}' AND rented_user_id = '{$_SESSION['user_id']}' LIMIT 1";
		$result = mysqli_query($Connection, $query);

		if($result){
			if(mysqli_num_rows($result) == 1){
				$data = mysqli_fetch_assoc($result);
				$rowcolor = status($data['status']);
				$income =  ($data['price']-$data['profit']);
				$bookking = true;
				$notifications = false;

					$booked_list.="<tr>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['post_id']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_user_id']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_first_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_last_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['brand_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['vehicle_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_time']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['price']} <i class=\"fas fa-money-check-alt\"></i></td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['profit']} <i class=\"fas fa-funnel-dollar\"></i></td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$income} <i class=\"fas fa-hand-holding-usd\"></i></td>";
					$booked_list.="</tr>";
			}else{
				$query = "SELECT post_id FROM rented_vehicles WHERE post_id = '{$_GET['post_id']}' LIMIT 1";
				$result = mysqli_query($Connection, $query);

				if($result){
					if(mysqli_num_rows($result) == 1){
						$bookking = false;
						$notifications = false;
					}else{
						header('Location:pfle.php?post_id=error');
					}
				}else{
					echo "Select query failed";
				}
			}
		}else{
			echo "Database query failed";
		}
	}else if(isset($_GET['notification']) && $_GET['notification'] == 'true'){
		$query = "SELECT * FROM booked_vehicles WHERE rented_user_id = '{$_SESSION['user_id']}' AND seen = 'no' ORDER BY post_id DESC";
		$result = mysqli_query($Connection, $query);

		if($result){
			if(mysqli_num_rows($result) > 0){
				$bookking = false;
				$notifications = true;
				while ($data = mysqli_fetch_assoc($result)) {
					if($data['is_deleted_by_user'] == 1){
						$rowcolor = '#355C7D';
					}else{
						$rowcolor = status($data['status']);
					}
					$income =  ($data['price']-$data['profit']);
					$h3 = '';

					switch ($data['status']) {
							case 'pending':
								$h3 = 'The booking is still pending.';
								break;
							case 'confirmed':
								$h3 = 'The booking has been confirmed by admins.';
								break;
							case 'deleted':
								$h3 = 'The booking has been deleted by admins.';
								break;
							case 'returned':
								$h3 = 'The booking vehicle has been returned by customer.';
								break;														
						}

					$notif.="<tr>";
					$notif.="<td style=\"background-color: $rowcolor; border: none; \">{$h3} #_{$data['post_id']}</td>";					
					$notif.="<td style=\"background-color: $rowcolor; border: none; \"><a href=\"notification-reader.php?post_id={$data['post_id']}\"><button name=\"seen\" style=\"background-color: $rowcolor; \"><i class=\"fas fa-times\"></i></button></a></td>";	
					$notif.="</tr>";

					$booked_list.="<tr>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['post_id']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_user_id']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_first_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_last_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['brand_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['vehicle_name']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['booked_time']}</td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['price']} <i class=\"fas fa-money-check-alt\"></i></td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$data['profit']} <i class=\"fas fa-funnel-dollar\"></i></td>";
					$booked_list.="<td style=\"background-color: $rowcolor; border: none; \">{$income} <i class=\"fas fa-hand-holding-usd\"></i></td>";
					$booked_list.="</tr>";
				}
			}else{
				$notifications = false;
				$bookking = false;
			}				
		}else{
			echo "Database query failed";
		}
	}else{
		header('Location:pfle.php?no_queries');
	}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Tripplin Car Rent</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="css/income.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

	<?php require_once('inc/hdr.php'); ?>


	<div class="Content">
		<h1>Income Summery</h1>

		<div class="Table">
			<?php  
				if($bookking || $notifications){
					if($notifications){
						?><div class="Notifi">
							<table>
								<?php echo $notif; ?>
							</table>
						</div><?php
					}
					?>
					<div class="tab">
					<table class="Income-list">
						<tr>
							<th>Post ID</th>
							<th>Booked ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Brand</th>
							<th>Vehicle</th>
							<th>Booked Time</th>
							<th>Price</th>
							<th>Charge</th>
							<th>Income</th>
						</tr>

						<?php echo $booked_list; ?>
					</table><!-- Income-list -->
					</div><!-- tab -->
					<?php
						if(isset($_GET['total_income']) && $_GET['total_income'] == 'true'){
							?><h2 style="width: 75%; background-color: #eee;">~ Total Income <i class="fas fa-hand-holding-usd"></i> : <?php echo $_SESSION['total_income']; ?>LKR ~</h2><?php
						}
					?>
					

					<div class="Explain">
						
						<h3><i class="fas fa-square" style="color: #3398dc;"></i> <span>Pending booking.</span></h3>
						<h3><i class="fas fa-square" style="color: #f39c11;"></i> <span>Confirmed by admins.</span></h3>
						<h3><i class="fas fa-square" style="color: #00bc8c;"></i> <span>Returned booked vehicle.</span></h3>
						<h3><i class="fas fa-square" style="color: #e84c3d;"></i> <span>Booking deleted by admins.</span></h3>
						<h3><i class="fas fa-square" style="color: #355C7D;"></i> <span>Booking deleted by user.</span></h3>
						
					</div><!-- Explain --><?php

				}else{
					if($bookking == false && $notifications == true){
						?><h2>Still No bookings for your vehicle/s <i class="far fa-frown"></i></h2><?php
					}else if($notifications == false && $bookking == true){
						?><h2>Still No Notifications <i class="far fa-frown"></i></h2><?php
					}else if($notifications == false && $bookking == false){
						?><h2>Still No bookings for your vehicle/s <i class="far fa-frown"></i></h2><?php
						?><!-- <h2>Still No Notifications</h2> --><?php
					}
				}
			?>

		</div><!-- Table -->

		
	</div><!-- Content -->


	<?php require_once('inc/ftr.php'); ?>
	<?php mysqli_close($Connection); ?>
</body>
</html>