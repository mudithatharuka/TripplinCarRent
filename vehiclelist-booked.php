
<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>

<?php  

	$cars_list = '';
	$vans_list = '';
	$busses_list = '';
	$offroads_list = '';

	$query = "SELECT * FROM booked_vehicles WHERE is_deleted_by_user != 1 ORDER BY post_id DESC";
	$result = mysqli_query($Connection, $query);

	if($result){
		if(mysqli_num_rows($result) >0){
			while($data = mysqli_fetch_assoc($result)){
				$sql = "SELECT * FROM rented_vehicles WHERE post_id = '{$data['rented_post_id']}' ORDER BY post_id DESC";
				$res = mysqli_query($Connection, $sql);
				if($res){
					$dat = mysqli_fetch_assoc($res);
					switch ($dat['tab']) {
						case 'rented_cars':
							$q = "SELECT * FROM booked_vehicles WHERE is_deleted_by_user != 1 AND rented_post_id = '{$data['rented_post_id']}' ORDER BY post_id DESC";
							$cars = mysqli_query($Connection, $q);
							$car = mysqli_fetch_assoc($cars);

								$rowcolor = status($car['status']);

								$cars_list.="<tr>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$car['post_id']}</td>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$car['rented_user_id']}</td>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$car['booked_user_id']}</td>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$car['booked_first_name']}</td>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$car['booked_last_name']}</td>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$car['brand_name']}</td>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$car['vehicle_name']}</td>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$car['booked_time']}</td>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$car['price']}</td>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$car['profit']}</td>";
								$cars_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \"><a href=\"view-vehicle.php?id={$car['rented_post_id']}\" class=\"cars\">View</a></td>";
								$cars_list.="</tr>";
							break;

						case 'rented_vans':
							$q = "SELECT * FROM booked_vehicles WHERE is_deleted_by_user != 1 AND rented_post_id = '{$data['rented_post_id']}' ORDER BY post_id DESC";
							$vans = mysqli_query($Connection, $q);
							$van = mysqli_fetch_assoc($vans);

								$rowcolor = status($van['status']);

								$vans_list.="<tr>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$van['post_id']}</td>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$van['rented_user_id']}</td>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$van['booked_user_id']}</td>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$van['booked_first_name']}</td>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$van['booked_last_name']}</td>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$van['brand_name']}</td>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$van['vehicle_name']}</td>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$van['booked_time']}</td>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$van['price']}</td>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$van['profit']}</td>";
								$vans_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \"><a href=\"view-vehicle.php?id={$van['rented_post_id']}\" class=\"vans\">View</a></td>";
								$vans_list.="</tr>";
							break;

						case 'rented_busses':
							$q = "SELECT * FROM booked_vehicles WHERE is_deleted_by_user != 1 AND rented_post_id = '{$data['rented_post_id']}' ORDER BY post_id DESC";
							$busses = mysqli_query($Connection, $q);
							$bus = mysqli_fetch_assoc($busses);

								$rowcolor = status($bus['status']);

								$busses_list.="<tr>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$bus['post_id']}</td>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$bus['rented_user_id']}</td>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$bus['booked_user_id']}</td>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$bus['booked_first_name']}</td>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$bus['booked_last_name']}</td>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$bus['brand_name']}</td>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$bus['vehicle_name']}</td>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$bus['booked_time']}</td>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$bus['price']}</td>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$bus['profit']}</td>";
								$busses_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \"><a href=\"view-vehicle.php?id={$bus['rented_post_id']}\" class=\"busses\">View</a></td>";
								$busses_list.="</tr>";
							break;

						case 'rented_off_roads':
							$q = "SELECT * FROM booked_vehicles WHERE is_deleted_by_user != 1 AND rented_post_id = '{$data['rented_post_id']}' ORDER BY post_id DESC";
							$offroads = mysqli_query($Connection, $q);
							$offroad = mysqli_fetch_assoc($offroads);

								$rowcolor = status($offroad['status']);

								$offroads_list.="<tr>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$offroad['post_id']}</td>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$offroad['rented_user_id']}</td>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$offroad['booked_user_id']}</td>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$offroad['booked_first_name']}</td>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$offroad['booked_last_name']}</td>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$offroad['brand_name']}</td>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$offroad['vehicle_name']}</td>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$offroad['booked_time']}</td>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$offroad['price']}</td>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \">{$offroad['profit']}</td>";
								$offroads_list.="<td style=\"background-color: $rowcolor; border: none; border-bottom: 1px solid #2e4044; \"><a href=\"view-vehicle.php?id={$offroad['rented_post_id']}\" class=\"offroads\">View</a></td>";
								$offroads_list.="</tr>";
							break;
					}
				}else{
					echo "Rented database query failed";
					die();
				}
			}
		}else{
			//echo "No any booked vehicles";
		}
	}else{
		echo "Booked database query failed";
		die();
	}

	// echo $query;
	// die();

	// if($cars){

	// 	if(mysqli_num_rows($cars) > 0){

	// 		while ($car = mysqli_fetch_assoc($cars)) {

	// 			$rowcolor = status($car['status']);

	// 			$cars_list.="<tr>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \">{$car['post_id']}</td>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \">{$car['rented_user_id']}</td>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \">{$car['booked_user_id']}</td>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \">{$car['booked_first_name']}</td>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \">{$car['booked_last_name']}</td>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \">{$car['brand_name']}</td>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \">{$car['vehicle_name']}</td>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \">{$car['booked_time']}</td>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \">{$car['price']}</td>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \">{$car['profit']}</td>";
	// 			$cars_list.="<td style=\"background-color: $rowcolor; border: none; \"><a href=\"view-vehicle.php?id={$car['rented_post_id']}\">View</a></td>";
	// 			$cars_list.="</tr>";
	// 		}

	// 	}else{
	// 		// echo "No cars to display";
	// 	}

	// }else{
	// 	echo "Database query failed";
	// }

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
							<th>Rented ID</th>
							<th>Booked ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Brand</th>
							<th>Vehicle</th>
							<th>Booked Time</th>
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
							<th>Rented ID</th>
							<th>Booked ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Brand</th>
							<th>Vehicle</th>
							<th>Booked Time</th>
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
							<th>Rented ID</th>
							<th>Booked ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Brand</th>
							<th>Vehicle</th>
							<th>Booked Time</th>
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
							<th>Rented ID</th>
							<th>Booked ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Brand</th>
							<th>Vehicle</th>
							<th>Booked Time</th>
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