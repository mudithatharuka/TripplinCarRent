<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php session_start(); ?>

<?php
	if(isset($_GET['category']) && ($_GET['category'] == 'rented' || $_GET['category'] == 'booked' || $_GET['category'] == 'user' || $_GET['category'] == 'admin')){

		if($_GET['category'] == 'rented'){
			if(isset($_GET['id'])){
				$query = "SELECT * FROM rented_vehicles WHERE post_id = '{$_GET['id']}' LIMIT 1";
				$result = mysqli_query($Connection, $query);
				if($result){
					if(mysqli_num_rows($result) == 1){
						$query = "UPDATE rented_vehicles SET is_deleted = 1 WHERE post_id = '{$_GET['id']}' LIMIT 1";
						$result = mysqli_query($Connection, $query);
						if($result){
							header('Location:vehiclelist-rented.php?deletion=successful');
						}else{
							echo "<b><h1>404</h1>Deletion failed</b>";
							die();
						}
					}else{
						header('Location:vehiclelist-rented.php?post_id=error');
					}
				}else{
					echo "<b><h1>404</h1>Database query failed</b>";
					die();
				}
			}else{
				echo "<b><h1>404</h1>Post ID failed</b>";
				die();
			}

		}else if($_GET['category'] == 'booked'){
			if(isset($_GET['id']) && isset($_GET['vehicle_id'])){
				$query = "SELECT * FROM booked_vehicles WHERE post_id = '{$_GET['id']}' LIMIT 1";
				$result = mysqli_query($Connection, $query);
				$sql = "SELECT * FROM rented_vehicles WHERE post_id = '{$_GET['vehicle_id']}' LIMIT 1";
				$res = mysqli_query($Connection, $sql);
				if($result && $res){
					if(mysqli_num_rows($result) == 1 && mysqli_num_rows($res) == 1){
						$query = "UPDATE booked_vehicles SET status = 'deleted' WHERE post_id = '{$_GET['id']}' LIMIT 1";
						$result = mysqli_query($Connection, $query);
						if($result){
							header('Location:view-vehicle.php?id='.$_GET['vehicle_id'].'&deletion=successful');
						}else{
							echo "<b><h1>404</h1>Deletion failed</b>";
							die();
						}
					}else{
						header('Location:view-vehicle.php?id='.$_GET['vehicle_id'].'&booked_id_or_post_id=error');
					}
				}else{
					echo "<b><h1>404</h1>Database query failed</b>";
					die();
				}
			}else{
				echo "<b><h1>404</h1>Post ID failed</b>";
				die();
			}

		}else if($_GET['category'] == 'admin'){
			if(isset($_GET['id'])){
				$query = "SELECT * FROM admin WHERE id = '{$_GET['id']}' LIMIT 1";
				$result = mysqli_query($Connection, $query);
				if($result){
					if(mysqli_num_rows($result) == 1){
						$query = "UPDATE admin SET is_deleted = 1 WHERE id = '{$_GET['id']}' LIMIT 1";
						$result = mysqli_query($Connection, $query);
						if($result){
							header('Location:admins.php?deletion=successful');
						}else{
							echo "<b><h1>404</h1>Deletion failed</b>";
							die();
						}
					}else{
						header('Location:admins.php?id=error');
					}
				}else{
					echo "<b><h1>404</h1>Database query failed</b>";
					die();
				}
			}else{
				echo "<b><h1>404</h1>Admin ID failed</b>";
				die();
			}
		}else{
			if(isset($_GET['id'])){
				$query = "SELECT * FROM user WHERE id = '{$_GET['id']}' LIMIT 1";
				$result = mysqli_query($Connection, $query);
				if($result){
					if(mysqli_num_rows($result) == 1){
						$query = "UPDATE user SET is_deleted = 1 WHERE id = '{$_GET['id']}' LIMIT 1";
						$result = mysqli_query($Connection, $query);
						if($result){
							$query = "SELECT * FROM rented_vehicles WHERE user_id = '{$_GET['id']}'";
							$result = mysqli_query($Connection, $query);
							if($result){
								if(mysqli_num_rows($result) > 0){
									$query = "UPDATE rented_vehicles SET is_deleted = 1 WHERE user_id = '{$_GET['id']}'";
									$result = mysqli_query($Connection, $query);
									if($result){
										header('Location:adminhome.php?deletion=successful_with_rents');
									}else{
										echo "<b><h1>404</h1>Second deletion failed</b>";
										die();				}
								}else{
									header('Location:adminhome.php?deletion=successful_no_rents');
								}
							}else{
								echo "<b><h1>404</h1>Inside database query failed</b>";
								die();
							}
						}else{
							echo "<b><h1>404</h1>Deletion failed</b>";
							die();
						}
					}else{
						header('Location:adminhome.php?id=error');
					}
				}else{
					echo "<b><h1>404</h1>Database query failed</b>";
					die();
				}
			}else{
				echo "<b><h1>404</h1>User ID failed</b>";
				die();
			}
		}

	}else{
		echo "<b><h1>404</h1>Category failed</b>";
		die();
	}
?>
	<?php mysqli_close($Connection); ?>