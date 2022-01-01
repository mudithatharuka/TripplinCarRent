<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>


<?php  

	if(!isset($_SESSION['admin_id'])){
		header("Location:adminlogin.php?login=false");
	}

	$admins_list = '';
	$search = '';

	if(isset($_GET['search'])){
		$search = mysqli_real_escape_string($Connection, $_GET['search']);
		$query = "SELECT * FROM admin WHERE (id LIKE '%{$search}%' OR name LIKE '%{$search}%' OR username LIKE '%{$search}%') AND  is_deleted = 0 ORDER BY id DESC";
	}else{
		$query = "SELECT * FROM admin WHERE is_deleted = 0 ORDER BY id DESC";
	}

	$admins = mysqli_query($Connection, $query);

	if($admins){

		if(mysqli_num_rows($admins) > 0){

			while ($admin = mysqli_fetch_assoc($admins)) {

				$admins_list.="<tr>";
				$admins_list.="<td>{$admin['id']}</td>";
				$admins_list.="<td>{$admin['name']}</td>";
				$admins_list.="<td>{$admin['username']}</td>";
				$admins_list.="<td>{$admin['phone']}</td>";
				$admins_list.="<td>{$admin['email']}</td>";
				$admins_list.="<td>{$admin['nic']}</td>";
				$admins_list.="<td>{$admin['last_login']}</td>";
				$admins_list.="<td><a href=\"view-admin.php?admin_id={$admin['id']}\">View</a></td>";
				$admins_list.="</tr>";
			}

		}else{
			// echo "No admins to display";
		}

	}else{
		echo "Database query failed";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin - Tripplin Car Rent</title>
	<link rel="stylesheet" type="text/css" href="css/adminhome.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>
<body>

	<div class="Container">
		<?php require_once('inc/adminhdr.php'); ?>

		<div class="Main">
			<div class="Mainbuttons">
				<p>
					<a href="vehiclelist-rented.php"><button class="rented">Rented vehicles</button></a>
					<a href="vehiclelist-booked.php"><button class="booked">Booked vehicles</button></a>
				</p>
			</div><!-- Mainbuttons -->

			<form action="admins.php" method="get">
				<div class="Search">
					<input type="text" name="search" placeholder="Search admin by id, name or username" value="<?php echo $search ?>" required autofocus>
				</div><!-- Search -->

			</form>
			<div class="Maintable">
				
				<table class="User-list">
				<tr>
					<th>Admin ID</th>
					<th>Name</th>
					<th>Username</th>
					<th>Phone</th>
					<th>Email</th>
					<th>NIC</th>
					<th>Last login</th>
					<th>Edit</th>
				</tr>

				<?php echo $admins_list; ?>

		</table><!-- User-list -->

			</div><!-- Maintable -->
		</div><!-- Main -->
	</div><!-- Container -->
	<?php mysqli_close($Connection); ?>
</body>
</html>