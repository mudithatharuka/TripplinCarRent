<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php session_start(); ?>

<?php 
	if(!isset($_GET['admin_id'])){
		header('Location:adminhome.php?admin_id=false');
	}else{
		$query = "SELECT * FROM admin WHERE id = '{$_GET['admin_id']}' LIMIT 1";
		$result = mysqli_query($Connection, $query);
		
		if($result){
			if(mysqli_num_rows($result) == 1){
				$data = mysqli_fetch_assoc($result);
			}else{
				header('Location:admins.php?admin_id=error');
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
			<nav  style="background-color: #BF0A30;">
				<h2>#_<?php echo $data['id']; ?> <span> <?php echo $data['username']; ?> <i class="fas fa-user-circle"></i></span></h2>
				<h3>Last Log In: <span> <?php echo $data['last_login']; ?></span></h3>
			</nav>

			<main>
				<label>Name:</label><h3><?php echo $data['name']; ?></h3>
				<div class="bal"></div>
				<label>Contact:</label><h3><?php echo $data['phone']; ?></h3>
				<div class="bal"></div>
				<label>NIC:</label><h3><?php echo $data['nic']; ?></h3>
				<div class="bal"></div>
				<label>Email:</label><h3><?php echo $data['email']; ?></h3>
				<div class="bal"></div>

				<?php
					if($_SESSION['admin_id'] == 1){
						?><a href="admin-delete.php?category=admin&id=<?php echo($_GET['admin_id']); ?>" onclick="return confirm('Are you sure you want to delete this admin?');"><div><button>Delete Admin</button></div></a><?php
					}
				?>

			</main>
		</div><!-- Details -->

	</div><!-- Container -->
	<?php mysqli_close($Connection); ?>
</body>
</html>