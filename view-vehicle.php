
<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>


<?php
	
	if(!isset($_GET['id'])){
		header('Location:vehiclelist.php?id=false');
	}else{
		if(isset($_GET['action']) && $_GET['action'] == 'confirm'){
			if (isset($_GET['booking']) && isset($_GET['id'])) {
				$query = "SELECT * FROM booked_vehicles WHERE post_id = '{$_GET['booking']}' AND status = 'pending' AND is_deleted_by_user != 1";
				$result = mysqli_query($Connection, $query);
				// echo $query;
				// die();
				$sql = "SELECT * FROM rented_vehicles WHERE post_id = '{$_GET['id']}' AND is_deleted != 1";
				$res = mysqli_query($Connection, $sql);
				if($result && $res){
					if(mysqli_num_rows($result) == 1 && mysqli_num_rows($res) == 1){
						$query = "UPDATE booked_vehicles SET status = 'confirmed', seen = 'no' WHERE post_id = '{$_GET['booking']}' LIMIT 1";
						$result = mysqli_query($Connection, $query);
						if($result){
							header('Location:view-vehicle.php?id='.$_GET['id'].'');
						}#else { echo('5');}
					}#else { echo('4');}
				}#else { echo "3";}
			}#else{ echo('2');}
		}else if(isset($_GET['action']) && $_GET['action'] == 'returned'){
			if (isset($_GET['booking']) && isset($_GET['id'])) {
				$query = "SELECT * FROM booked_vehicles WHERE post_id = '{$_GET['booking']}' AND status = 'confirmed' AND is_deleted_by_user != 1";
				$result = mysqli_query($Connection, $query);
				// echo $query;
				// die();
				$sql = "SELECT * FROM rented_vehicles WHERE post_id = '{$_GET['id']}' AND is_deleted != 1";
				$res = mysqli_query($Connection, $sql);
				if($result && $res){
					if(mysqli_num_rows($result) == 1 && mysqli_num_rows($res) == 1){
						$query = "UPDATE booked_vehicles SET status = 'returned', seen = 'no' WHERE post_id = '{$_GET['booking']}' LIMIT 1";
						$result = mysqli_query($Connection, $query);
						if($result){
							header('Location:view-vehicle.php?id='.$_GET['id'].'');
						}#else { echo('5');}
					}#else { echo('4');}
				}#else { echo "3";}
			}#else{ echo('2');}
		}

		$query = "SELECT * FROM rented_vehicles WHERE post_id = '{$_GET['id']}' limit 1";
		$result = mysqli_query($Connection, $query);
		if(mysqli_num_rows($result) != 1){
			header('Location:vehiclelist.php?id=not_available');
		}else{

			$result_set = mysqli_fetch_assoc($result);

			switch ($result_set['kind_of_vehicle']) {
				case 'Hatchback':
				case 'Wagon':
				case 'Sedan':
				case 'Coupe':
				case 'Sport':
					$print = 'Cars';
					break;
				case 'Off Road':
				case 'Pickup':
					$print = 'Off Road and Jeeps';
					break;
				case 'Van':
					$print = 'Vans';
					break;
				case 'Bus':
					$print = 'Busses';
					break;
				default:
					
					break;
			}

		}
	}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Admin - Tripplin Car Rent</title>
	<link rel="stylesheet" type="text/css" href="css/view-vehicle.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>

	<?php require_once('inc/adminhdr.php'); ?>

	<main>
		<?php $bgc = bgc($result_set['tab']) ?>
		<div class="Topic clearfix" style="background-color: <?php echo $bgc; ?>">
			<label>#<?php echo $result_set['post_id']; ?> <span>by</span> | - <a href="view-user.php?user_id=<?php echo($result_set['user_id']); ?>" style="font-family: sans-serif; font-weight: initial; color: #1a1a1a;">| [<?php echo $result_set['user_id']; ?>]</a> ~</label><style> .Topic label a:hover{color: #fff; border-bottom: 2px solid #1a1a1a;}</style>
			<h1><?php echo $result_set['brand_name']; ?> <?php echo $result_set['vehical_name']; ?> <?php echo $result_set['mnf_year']; ?> <?php echo $result_set['type_of_vehicle']; ?></h1>
			<h3><?php echo $result_set['kind_of_vehicle']; ?> </h3>
		</div><!-- Topic -->

		<div class="Des">
			
			<div class="Images">
				<img src="web_img/<?php echo($print); ?>/<?php echo($result_set['kind_of_vehicle']); ?>/<?php echo($result_set['post_id']) ?>/<?php echo($result_set['front_side_img']); ?>">
				<img src="web_img/<?php echo($print); ?>/<?php echo($result_set['kind_of_vehicle']); ?>/<?php echo($result_set['post_id']) ?>/<?php echo($result_set['rear_side_img']); ?>">
				<img src="web_img/<?php echo($print); ?>/<?php echo($result_set['kind_of_vehicle']); ?>/<?php echo($result_set['post_id']) ?>/<?php echo($result_set['side_view_img']); ?>">
				<img src="web_img/<?php echo($print); ?>/<?php echo($result_set['kind_of_vehicle']); ?>/<?php echo($result_set['post_id']) ?>/<?php echo($result_set['f_compartment_img']); ?>">
				<img src="web_img/<?php echo($print); ?>/<?php echo($result_set['kind_of_vehicle']); ?>/<?php echo($result_set['post_id']) ?>/<?php echo($result_set['r_compartment_img']); ?>">
				<img src="web_img/<?php echo($print); ?>/<?php echo($result_set['kind_of_vehicle']); ?>/<?php echo($result_set['post_id']) ?>/<?php echo($result_set['d_compartment_img']); ?>">
				<img src="web_img/<?php echo($print); ?>/<?php echo($result_set['kind_of_vehicle']); ?>/<?php echo($result_set['post_id']) ?>/<?php echo($result_set['e_compartment_img']); ?>">
				<img src="web_img/<?php echo($print); ?>/<?php echo($result_set['kind_of_vehicle']); ?>/<?php echo($result_set['post_id']) ?>/<?php echo($result_set['extra_wheel_img']); ?>">
			</div><!-- Images -->

			 <div class="Contain">
			 	<style type="text/css">
			 		.Contain { border-radius: 20px; border: 2px solid <?php echo $bgc; ?> }
			 		.Contain h3, .Contain label { color: <?php echo $bgc; ?> }
			 		.Contain h3 { border-bottom: 1px solid <?php echo $bgc; ?> }
			 		/*.Contain h3:last-child { border: none; }*/
			 	</style>
			 	 <p><label>Full Name: </label><h3><?php echo $result_set['full_name']; ?></h3></p>
				 <p><label>Province: </label><h3><?php echo $result_set['province']; ?></h3></p>
				 <p><label>District: </label><h3><?php echo $result_set['district']; ?></h3></p>
				 <p><label>Condition: </label><h3><?php echo $result_set['vehicle_condition']; ?></h3></p>
				 <p><label>Contact: </label><h3><?php echo $result_set['phone_code']; ?><?php echo $result_set['contact_no']; ?></h3></p>
				 <p><label>Nic: </label><h3><?php echo $result_set['nic']; ?></h3></p>
				 <p><label>Email: </label><h3><?php echo $result_set['email']; ?></h3></p>
				 <p><label>Price: </label><h3><?php echo $result_set['price']; ?></h3></p>
				 <p><label>Profit: </label><h3><?php echo $result_set['profit']; ?></h3></p>
				 <p><label>Description: </label><h3><?php echo $result_set['description']; ?></h3></p>

				 
				 	<?php
				 		$query = "SELECT * FROM booked_vehicles WHERE rented_post_id = '{$_GET['id']}' AND ( status != 'deleted' AND status != 'returned' ) AND is_deleted_by_user != 1";
				 		$result = mysqli_query($Connection, $query);
				 		// echo $query;
				 		// die();

				 		if($result){
				 			if(mysqli_num_rows($result) == 1){
				 				$data = mysqli_fetch_assoc($result);
				 				$bgc = status($data['status']);
								?><div class="Bookingdet" style="background-color: <?php echo $bgc; ?>">
									<h2>Booking Details:</h2>
									<h5>#<?php echo $data['post_id']; ?> @<?php echo $data['booked_time']; ?></h5>

									<a href="view-user.php?user_id=<?php echo($data['booked_user_id']) ?>"><p>Booked by: <?php echo $data['booked_first_name'];echo " ";echo $data['booked_last_name']; ?></p></a>
									<p>Picking date: <?php echo $data['picking_date']; ?></p>
									<p>Returning date: <?php echo $data['returning_date']; ?></p>
									<p>Status: <?php echo $data['status']; ?></p>
									<?php
										if($data['status'] == 'pending'){
											?><a href="view-vehicle.php?action=confirm&booking=<?php echo($data['post_id']); ?>&id=<?php echo($_GET['id']); ?>"><button class="confirm" name="confirm">Confirm</button></a>
											<a href="admin-delete.php?category=booked&id=<?php echo($data['post_id']); ?>&vehicle_id=<?php echo($_GET['id']); ?>" onclick="return confirm('Are you sure you want to delete this booking?');"><button class="delete" name="delete">Delete</button></a><?php
										}else if($data['status'] == 'confirmed'){
											?><a href="view-vehicle.php?action=returned&booking=<?php echo($data['post_id']); ?>&id=<?php echo($_GET['id']); ?>"><button class="returned" name="returned">Returned</button></a><?php
										}
									?>
								</div><!-- Bookingdet --><?php
				 			}else if(mysqli_num_rows($result) == 0){
				 				?><a href="admin-delete.php?category=rented&id=<?php echo($_GET['id']) ?>" onclick="return confirm('Are you sure you want to delete this vehicle?');"><div><button>Delete vehicle</button></div></a><?php
				 			}else{
				 				echo "<b><h1>404</h1>Databasess query failed</b>";
								die();
				 			}
				 		}else{
				 			echo "<b><h1>404</h1>Database query failed</b>";
							die();
				 		}
				 	?>

				 
			 </div><!-- Contain -->
		</div><!-- Des -->
	</main>
	<?php mysqli_close($Connection); ?>
</body>
</html>