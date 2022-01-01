<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php session_start(); ?>

<?php 
	if(!isset($_GET['user_id'])){
		header('Location:adminhome.php?user_id=false');
	}else{
		$query = "SELECT * FROM user WHERE id = '{$_GET['user_id']}' LIMIT 1";
		$result = mysqli_query($Connection, $query);
		
		if($result){
			if(mysqli_num_rows($result) == 1){
				$data = mysqli_fetch_assoc($result);
			}else{
				header('Location:adminhome.php?user_id=error');
			}
		}else{
			echo "<b><h1>404</h1>Database query failed</b>";
			die();
		}
	}

?>




<!DOCTYPE html>
<html>
<head>
	<title>Admin - Tripplin Car Rent</title>
	<link rel="stylesheet" type="text/css" href="css/view-user.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>

	<div class="Container">

		<?php require_once('inc/adminhdr.php'); ?>
		
		<div class="Details">
			<nav>
				<h2>#_<?php echo $data['id']; ?> <span> <?php echo $data['username']; ?> <i class="fas fa-user-circle"></i></span></h2>
				<h3>Last Log In: <span> <?php echo $data['last_login']; ?></span></h3>
			</nav>

			<main>
				<label>First Name:</label><h3><?php echo $data['first_name']; ?></h3>
				<div class="bal"></div>
				<label>Last Name:</label><h3><?php echo $data['last_name']; ?></h3>
				<div class="bal"></div>
				<label>Address line 01:</label><h3><?php echo $data['ad_line1']; ?></h3>
				<div class="bal"></div>
				<?php  
					if($data['ad_line2']){
						?><label>Address line 02:</label><h3><?php echo $data['ad_line2']; ?></h3>
						<div class="bal"></div><?php
					}
				?><?php  
					if($data['ad_line3']){
						?><label>Address line 03:</label><h3><?php echo $data['ad_line3']; ?></h3>
						<div class="bal"></div><?php
					}
				?>
				<label>Contact:</label><h3><?php echo $data['phone_code']; ?><?php echo $data['phone_number']; ?></h3>
				<div class="bal"></div>
				<label>NIC:</label><h3><?php echo $data['nic']; ?></h3>
				<div class="bal"></div>
				<label>Email:</label><h3><?php echo $data['email']; ?></h3>
				<div class="bal"></div>
				<label>Gender:</label><h3><?php echo $data['gender']; ?></h3>
				<div class="bal"></div>

				<div class="Deals">
					
					<h2>Rented vehicles</h2>
					<?php
						$query = "SELECT * FROM rented_vehicles WHERE user_id = '{$_GET['user_id']}' AND is_deleted != 1 ORDER BY post_id DESC";
						$result = mysqli_query($Connection, $query);

						if($result){
							if(mysqli_num_rows($result) > 0){
								while($data = mysqli_fetch_assoc($result)){
									?><a href="view-vehicle.php?id=<?php echo($data['post_id']); ?>">
										<h4 style="color: #cccc99; padding-left: 10px;">#Post_Id: <?php echo $data['post_id']; ?></h4>
										<h3 style="border-bottom: none;"><?php echo $data['brand_name']; ?> <?php echo $data['vehical_name']; ?></h3>
										<h3 style="margin-bottom: 25px; color: #cccc99;">Price: <?php echo $data['price']; ?> | Profit: <?php echo $data['profit']; ?></h3>
									</a><?php
								}
							}else{
								?><h3 style="color: #cccc99; border-bottom: none;">No rented vehicles.</h3><?php
							}
						}else{
							echo "<b><h1>404</h1>Database query failed</b>";
							die();
						}
					?>

					<h2>Booked vehicles</h2>
					<?php
						$query = "SELECT * FROM booked_vehicles WHERE booked_user_id = '{$_GET['user_id']}' AND is_deleted_by_user != 1 /*AND status != 'deleted'*/ ORDER BY post_id DESC";
						$result = mysqli_query($Connection, $query);

						if($result){
							if(mysqli_num_rows($result) > 0){
								while($data = mysqli_fetch_assoc($result)){
									$bgc = status($data['status']);
									?><a href="view-vehicle.php?id=<?php echo($data['rented_post_id']); ?>">
										<h4 style="color: #cccc99; padding-left: 10px;">#Post_Id: <?php echo $data['post_id']; ?></h4>
										<h6 style="color: #000; padding-left: 10px;">@ <?php echo $data['booked_time']; ?></h6>
										<h3 style="border-bottom: none;"><?php echo $data['brand_name']; ?> <?php echo $data['vehicle_name']; ?></h3>
										<h3 style="border-bottom: none; border-radius: 20px; padding-left: 20px; background-color: <?php echo($bgc); ?> ">Status: <?php echo $data['status']; ?></h3>
										<h3 style="margin-bottom: 25px; color: #cccc99;">Price: <?php echo $data['price']; ?> | Profit: <?php echo $data['profit']; ?></h3>
									</a><?php
								}
							}else{
								?><h3 style="color: #cccc99; border-bottom: none;">No booked vehicles.</h3><?php
							}
						}else{
							echo "<b><h1>404</h1>Database query failed</b>";
							die();
						}
					?>

				</div><!-- Deals -->

				<?php
					$query = "SELECT * FROM booked_vehicles WHERE (booked_user_id = '{$_GET['user_id']}' OR rented_user_id = '{$_GET['user_id']}') AND is_deleted_by_user != 1 AND status != 'deleted'  AND status != 'returned' ORDER BY post_id DESC";
					$result = mysqli_query($Connection, $query);

					// echo $query;
					// die();

					if($result){
						if(mysqli_num_rows($result) > 0){
							?><h4 style="color: red; font-family: sans-serif; padding: 5px 20px; background-color: #eee; border-radius: 5px; margin-top: 60px;"><i class="fas fa-exclamation-circle"></i> Unable to delete this user at this moment!</h4><?php
						}else{
							?><a href="admin-delete.php?category=user&id=<?php echo($_GET['user_id']); ?>" onclick="return confirm('Are you sure you want to delete this user?');"><div><button>Delete User</button></div></a><?php
						}
					}else{
						echo "<b><h1>404</h1>Database query failed</b>";
						die();
					}

				?>

			</main>
		</div><!-- Details -->

	</div><!-- Container -->
	<?php mysqli_close($Connection); ?>
</body>
</html>