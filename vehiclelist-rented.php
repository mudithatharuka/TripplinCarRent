
<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>

<?php  

	$cars_list = '';
	$vans_list = '';
	$busses_list = '';
	$offroads_list = '';

	$query = "SELECT * FROM rented_vehicles WHERE is_deleted = 0 AND tab = 'rented_cars' ORDER BY post_id DESC";
		$cars = mysqli_query($Connection, $query);
	$query = "SELECT * FROM rented_vehicles WHERE is_deleted = 0 AND tab = 'rented_vans' ORDER BY post_id DESC";
		$vans = mysqli_query($Connection, $query);
	$query = "SELECT * FROM rented_vehicles WHERE is_deleted = 0 AND tab = 'rented_busses' ORDER BY post_id DESC";
		$busses = mysqli_query($Connection, $query);
	$query = "SELECT * FROM rented_vehicles WHERE is_deleted = 0 AND tab = 'rented_off_roads' ORDER BY post_id DESC";
		$offroads = mysqli_query($Connection, $query);

	// echo $query;
	// die();

	if($cars){
		if(mysqli_num_rows($cars) > 0){
			while ($car = mysqli_fetch_assoc($cars)) {
				$cars_list.="<tr>";
				$cars_list.="<td>{$car['post_id']}</td>";
				$cars_list.="<td>{$car['user_id']}</td>";
				$cars_list.="<td>{$car['province']}</td>";
				$cars_list.="<td>{$car['brand_name']}</td>";
				$cars_list.="<td>{$car['vehical_name']}</td>";
				$cars_list.="<td>{$car['kind_of_vehicle']}</td>";
				$cars_list.="<td>{$car['price']}</td>";
				$cars_list.="<td>{$car['profit']}</td>";
				$cars_list.="<td><a href=\"view-vehicle.php?id={$car['post_id']}\" class=\"cars\">View</a></td>";
				$cars_list.="</tr>";
			}
		}else{
			// echo "No cars to display";
		}
	}else{
		echo "Car database query failed";
		die();
	}	

	if($vans){
		if(mysqli_num_rows($vans) > 0){
			while ($van = mysqli_fetch_assoc($vans)) {
				$vans_list.="<tr>";
				$vans_list.="<td>{$van['post_id']}</td>";
				$vans_list.="<td>{$van['user_id']}</td>";
				$vans_list.="<td>{$van['province']}</td>";
				$vans_list.="<td>{$van['brand_name']}</td>";
				$vans_list.="<td>{$van['vehical_name']}</td>";
				$vans_list.="<td>{$van['kind_of_vehicle']}</td>";
				$vans_list.="<td>{$van['price']}</td>";
				$vans_list.="<td>{$van['profit']}</td>";
				$vans_list.="<td><a href=\"view-vehicle.php?id={$van['post_id']}\" class=\"vans\">View</a></td>";
				$vans_list.="</tr>";
			}
		}else{
			// echo "No vans to display";
		}
	}else{
		echo "Van database query failed";
		die();
	}	

	if($busses){
		if(mysqli_num_rows($busses) > 0){
			while ($bus = mysqli_fetch_assoc($busses)) {
				$busses_list.="<tr>";
				$busses_list.="<td>{$bus['post_id']}</td>";
				$busses_list.="<td>{$bus['user_id']}</td>";
				$busses_list.="<td>{$bus['province']}</td>";
				$busses_list.="<td>{$bus['brand_name']}</td>";
				$busses_list.="<td>{$bus['vehical_name']}</td>";
				$busses_list.="<td>{$bus['kind_of_vehicle']}</td>";
				$busses_list.="<td>{$bus['price']}</td>";
				$busses_list.="<td>{$bus['profit']}</td>";
				$busses_list.="<td><a href=\"view-vehicle.php?id={$bus['post_id']}\" class=\"busses\">View</a></td>";
				$busses_list.="</tr>";
			}
		}else{
			// echo "No busses to display";
		}
	}else{
		echo "Bus database query failed";
		die();
	}	

	if($offroads){
		if(mysqli_num_rows($offroads) > 0){
			while ($offroad = mysqli_fetch_assoc($offroads)) {
				$offroads_list.="<tr>";
				$offroads_list.="<td>{$offroad['post_id']}</td>";
				$offroads_list.="<td>{$offroad['user_id']}</td>";
				$offroads_list.="<td>{$offroad['province']}</td>";
				$offroads_list.="<td>{$offroad['brand_name']}</td>";
				$offroads_list.="<td>{$offroad['vehical_name']}</td>";
				$offroads_list.="<td>{$offroad['kind_of_vehicle']}</td>";
				$offroads_list.="<td>{$offroad['price']}</td>";
				$offroads_list.="<td>{$offroad['profit']}</td>";
				$offroads_list.="<td><a href=\"view-vehicle.php?id={$offroad['post_id']}\" class=\"offroads\">View</a></td>";
				$offroads_list.="</tr>";
			}
		}else{
			// echo "No offroads to display";
		}
	}else{
		echo "Off road database query failed";
		die();
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

		<div class="Category">
			<div class="Categorybut">
				
				<div style="display: inline-block;" class="cCar"><button class="car" onclick="carButtonStyle()">Car <i class="fas fa-car-side"></i></button></div>
				<div style="display: inline-block;" class="vVan"><button class="van" onclick="vanButtonStyle()">Van <i class="fas fa-shuttle-van"></i></button></div>
				<div style="display: inline-block;" class="oOffroad"><button class="offroad" onclick="offroadButtonStyle()">Off Road <i class="fas fa-truck-monster"></i></button></div>
				<div style="display: inline-block;" class="bBus"><button class="bus" onclick="busButtonStyle()">Bus <i class="fas fa-bus"></i></button></div>

				


			</div><!-- Categorybut -->
		</div><!-- Category -->

		<div class="Vehicletable">
				
				<div class="Cartable">
					<table class="Car-list">
						<tr>
							<th>Post ID</th>
							<th>User ID</th>
							<th>Province</th>
							<th>Brand</th>
							<th>Vehicle</th>
							<th>Kind</th>
							<th>Price</th>
							<th>Profit</th>
							<th>Edit</th>
						</tr>

						<?php echo $cars_list; ?>
					</table><!-- Car-list -->
				</div><!-- Cartable -->
				
				<div class="Vantable" style="display: none;">
					<table class="Van-list">
						<tr>
							<th>Post ID</th>
							<th>User ID</th>
							<th>Province</th>
							<th>Brand</th>
							<th>Vehicle</th>
							<th>Kind</th>
							<th>Price</th>
							<th>Profit</th>
							<th>Edit</th>
						</tr>

						<?php echo $vans_list; ?>
					</table><!-- Van-list -->
				</div><!-- Vantable -->

				<div class="Bustable" style="display: none;">
					<table class="Bus-list">
						<tr>
							<th>Post ID</th>
							<th>User ID</th>
							<th>Province</th>
							<th>Brand</th>
							<th>Vehicle</th>
							<th>Kind</th>
							<th>Price</th>
							<th>Profit</th>
							<th>Edit</th>
						</tr>

						<?php echo $busses_list; ?>
					</table><!-- Bus-list -->
				</div><!-- Bustable -->

				<div class="Offroadtable" style="display: none;">
					<table class="Offroad-list">
						<tr>
							<th>Post ID</th>
							<th>User ID</th>
							<th>Province</th>
							<th>Brand</th>
							<th>Vehicle</th>
							<th>Kind</th>
							<th>Price</th>
							<th>Profit</th>
							<th>Edit</th>
						</tr>

						<?php echo $offroads_list; ?>
					</table><!-- Offroad-list -->
				</div><!-- Offroadtable -->

				<script>



					const cCar = document.querySelector(".cCar");
					const vVan = document.querySelector(".vVan");
					const oOffroad = document.querySelector(".oOffroad");
					const bBus = document.querySelector(".bBus");

					const buttonCar = document.querySelector(".car");
					const buttonVan = document.querySelector(".van");
					const buttonOffroad = document.querySelector(".offroad");
					const buttonBus = document.querySelector(".bus");

					const cartable = document.querySelector(".Cartable");
					const vantable = document.querySelector(".Vantable");
					const bustable = document.querySelector(".Bustable");
					const offroadtable = document.querySelector(".Offroadtable");

					cCar.addEventListener('click', ()=>{
						cartable.style.display = "flex";
						vantable.style.display = "none";
						bustable.style.display = "none";
						offroadtable.style.display = "none";
				
					});

					vVan.addEventListener('click', ()=>{
						vantable.style.display = "flex";
						cartable.style.display = "none";
						bustable.style.display = "none";
						offroadtable.style.display = "none";
					});
					
					bBus.addEventListener('click', ()=>{
						bustable.style.display = "flex";
						cartable.style.display = "none";
						vantable.style.display = "none";
						offroadtable.style.display = "none";
					});
					
					oOffroad.addEventListener('click', ()=>{
						offroadtable.style.display = "flex";
						cartable.style.display = "none";
						vantable.style.display = "none";
						bustable.style.display = "none";
					});

				</script>

	</div><!-- Container -->
	<?php mysqli_close($Connection); ?>
</body>
</html>