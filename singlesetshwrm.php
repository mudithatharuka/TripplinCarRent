<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>

<?php 
	$search = '';
	if(!isset($_GET['print'])){
		header('Location:shwrm.php?category=false');
	}else{
		if($_GET['print'] != 'Cars' && $_GET['print'] != 'Vans' && $_GET['print'] != 'Busses' && $_GET['print'] != 'Off_Road_and_Jeeps' && $_GET['print'] != 'Search'){
			header('Location:shwrm.php?category=error');	
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

			<div class="Cont">
				<div class="Content3 clearfix">
						
						<div class="Advice">
							<h2>Get great deals on a car rental and save big</h2>
							<h5>Trying to find the best car rental deal?</h5>
							<p>There is no need to look further – you can always find a special offer and save big on NinoRentaCar.com!<br><br>Cooperating with hundreds of global and local car rental suppliers, we provide a wide choice of vehicles of all classes and find the perfect car for your journey. NinoRentaCar.com is ready to assist you whatever your question is and wherever you are in the world.</p>
						</div><!-- Advice -->

						<div class="Hotline">
							<h2>Hot-Line:</h2>
							<h1><i class="fas fa-phone-alt"></i></h1>
							<h3>+94 (011) 678 90 21</h3>
							<h6>Call Center Working Hours</h6>
							<h6>Mon – Fri: 8:00 AM — 11:00 PM GMT</h6>
							<h6>Sat – Sun: 8:00 AM — 9:00 PM GMT</h6>
						</div><!-- Hotline -->

						<div class="Advertiesment1">
							<img src="img/attachment_48313450.gif" alt="Advertiesment1">
						</div><!-- Advertiesment1 -->
						<div class="Resp-ad">
							<img src="img/motorway-banner.gif" alt="Advertiesment1">
						</div><!-- Resp-ad -->

				</div><!-- Content3 -->
			</div><!-- Cont -->

			<div class="empty"></div>


			<form action="singlesetshwrm.php?print=Search" action="get">
				<div class="Search">
					<input type="hidden" name="print" value="Search">
					<input type="text" name="search" placeholder="    Search the type, name or brand of the vehicle and hit enter" required value="<?php if(isset($_GET['search'])){ echo($_GET['search']); } ?>">
				</div><!-- Search -->
			</form>


	<div class="Content">
		
		<div class="Itemhead_sss">
			<?php 
				if(isset($_GET['search'])){
					$search = mysqli_real_escape_string($Connection, $_GET['search']);
					$query = "SELECT * FROM rented_vehicles WHERE (type_of_vehicle LIKE '%{$search}%' OR vehical_name LIKE '%{$search}%' OR brand_name LIKE '%{$search}%') AND  is_deleted = 0 ORDER BY post_id DESC";
					// echo $query;
					// die();
					?><h1>All RENTED SEARCH RESULTS</h1><?php
				}else{
					switch ($_GET['print']) {
						case 'Cars':
							$query = "SELECT * FROM rented_vehicles WHERE kind_of_vehicle = 'Hatchback' OR kind_of_vehicle = 'Wagon' OR kind_of_vehicle = 'Sedan' OR kind_of_vehicle = 'Coupe' OR kind_of_vehicle = 'Sport' ORDER BY post_id DESC";
							?><h1>All RENTED CARS</h1><?php
							break;
						case 'Vans':
							$query = "SELECT * FROM rented_vehicles WHERE kind_of_vehicle = 'Van' ORDER BY post_id DESC";
							?><h1>All RENTED VANS</h1><?php
							break;
						case 'Off_Road_and_Jeeps':
							$query = "SELECT * FROM rented_vehicles WHERE kind_of_vehicle = 'Off Road' OR kind_of_vehicle = 'Pickup' OR kind_of_vehicle = 'SUV' ORDER BY post_id DESC";
							?><h1>All RENTED OFF ROADS</h1><?php
							break;
						case 'Busses':
							$query = "SELECT * FROM rented_vehicles WHERE kind_of_vehicle = 'Bus' ORDER BY post_id DESC";
							?><h1>All RENTED BUSSES</h1><?php
							break;
					}
				}	
			 ?>

			<?php
					
					$result = mysqli_query($Connection, $query);

					// echo $query;
					// die();

						if ($result) {
							if(mysqli_num_rows($result) > 0){
								while ($data = mysqli_fetch_assoc($result)) {

										$kind = print_kind($data['kind_of_vehicle']);
										?><div class="Item">
											<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['front_side_img']); ?>" alt="Vehicl photo here">
											<h3><?php echo $data['vehical_name']; ?></h3>
											<p><?php echo $data['mnf_year']; ?></p>
											<p><?php echo $data['province']; ?> Province</p>
											<p><?php echo $data['district']; ?> District</p>
											<h3 style="color: yellow"><?php echo $data['price']; ?> /=<br><span style="color: #808080;">LKR per day</span></h3>
											<a href="singlevehicle.php?post_id=<?php echo($data['post_id']) ?>"><button type="submit" name="take_a_look">Take A Look</button></a>				
										</div><!-- car --><?php
									
								}
							}else{
								echo "<h3 style=\"padding: 10px 0 20px 0; text-align: center; color: #aaa; font-family: sans-serif;\">No rented vehicles are found</h3>";
							}
						}else{
							echo "Databade query failed";
						}
				?>

			<div class="empty"></div>
		</div><!-- Itemhead_sss -->
		

		

	</div><!-- Content -->



	<?php require_once('inc/ftr.php');?>

	<?php mysqli_close($Connection); ?>
</body>
</html>