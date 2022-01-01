<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>


<?php  

	if(!isset($_SESSION['admin_id'])){
		header("Location:adminlogin.php?login=false");
	}

	$users_list = '';
	$search = '';

	if(isset($_GET['search'])){
		$search = mysqli_real_escape_string($Connection, $_GET['search']);
		$query = "SELECT * FROM user WHERE (id LIKE '%{$search}%' OR first_name LIKE '%{$search}%' OR username LIKE '%{$search}%') AND  is_deleted = 0 ORDER BY id DESC";
	}else{
		$query = "SELECT * FROM user WHERE is_deleted = 0 ORDER BY id DESC";
	}

	$users = mysqli_query($Connection, $query);

	if($users){

		if(mysqli_num_rows($users) > 0){

			while ($user = mysqli_fetch_assoc($users)) {

				$users_list.="<tr>";
				$users_list.="<td>{$user['id']}</td>";
				$users_list.="<td>{$user['first_name']}</td>";
				$users_list.="<td>{$user['username']}</td>";
				$users_list.="<td>{$user['phone_code']}</td>";
				$users_list.="<td>{$user['phone_number']}</td>";
				$users_list.="<td>{$user['email']}</td>";
				$users_list.="<td>{$user['nic']}</td>";
				$users_list.="<td>{$user['last_login']}</td>";
				$users_list.="<td><a href=\"view-user.php?user_id={$user['id']}\">View</a></td>";
				$users_list.="</tr>";
			}

		}else{
			// echo "No users to display";
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

			<form action="adminhome.php" method="get">
				<div class="Search">
					<input type="text" name="search" placeholder="Search user by id, first name or username" value="<?php echo $search ?>" required autofocus>
				</div><!-- Search -->

			</form>
			<div class="Maintable">
				
				<table class="User-list">
				<tr>
					<th>User ID</th>
					<th>First Name</th>
					<th>Username</th>
					<th>Phone code</th>
					<th>Phone</th>
					<th>Email</th>
					<th>NIC</th>
					<th>Last login</th>
					<th>Edit</th>
				</tr>

				<?php echo $users_list; ?>

		</table><!-- User-list -->

			</div><!-- Maintable -->
		</div><!-- Main -->
	</div><!-- Container -->
	<?php mysqli_close($Connection); ?>
</body>
</html>