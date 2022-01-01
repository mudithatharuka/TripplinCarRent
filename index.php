<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php $search = ''; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tripplin Car Rent</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="css/hme.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<?php require_once('inc/hdr.php'); ?>

		<header>

			<div class="Header">

				<div class="Header-Col1">
					<div class="Logo">
						<img src="img/icons/downloads_a22fb3cc-b248-4154-bd54-002a313d2126_22c784e89a3879193cc7a6fd79f87d81-removebg-preview1.png" alt="Logo">
					</div><!--Logo-->

					<div class="Social-Media">
						<ul>
							<li><a href="#"><i class="fab fa-linkedin fa-fw"></i></a></li>
							<li><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
							<li><a href="#"><i class="fab fa-pinterest fa-fw"></i></a></li>
							<li><a href="#"><i class="fab fa-facebook fa-fw"></i></a></li>
							<li><a href="#"><i class="fas fa-rss fa-fw"></i></a></li>
						</ul>
					</div><!--Social-Media-->

				</div><!--Header-Col-->

				<div class="Header-Col2">

					<div class="Text">
						<h1>Tripplin Car Rent</h1>
					</div><!--Text-->

					<div class="Paragraph">
						<p>Welcome to Tripplin Car Rent, your number one source for all <br>type of Car Renting and Car Booking. </p>
					</div><!--Paragraph-->

					<div class="button1">
						<a href="shwrm.php"><button>SHOWROOM</button></a>
					</div>

				</div><!--Header-Col-->


			</div><!--Header-->

		</header>

		<div class="First">

			<div class="Selection">
				<h1>SELECT WHAT YOU WANT</h1>
			</div><!--Selection-->

			
			<div class="button2">
				<a href="rntacr.php"><button>RENT A CAR</button></a>
			</div>
			<div class="button3">	
				<a href="shwrm.php"><button>BOOK A CAR</button></a>
			</div>

			<div class="AboutUs">

				<div class="ParaAboutUs">

					<h1>ABOUT US</h1>

					<p>

					Welcome to Tripplin Car Rent, your number one source for all type of Car Renting and Car Booking. We're dedicated to giving you the very best of Car Rentong & Booking facilities, with a focus on Fair price rates, Comfertable ride, Your protection & Safty, and Responsible service.Tripplin Car Rent has come a long way from its beginnings in Colombo..
				
					</p>

					<a href="abus.php">Read More &raquo;</a>
					
				</div><!--ParaAboutUs-->

				<div class="AboutUsImg">
					<img src="img/car-rental-company.jpg" alt="About Us Image">
				</div><!--AboutUsImg-->

			</div><!--About Us-->
		
		</div><!--First-->

			<form action="singlesetshwrm.php?print=Search" action="get">
				<div class="Search">
					<input type="hidden" name="print" value="Search">
					<input type="text" name="search" placeholder="    Search the type, name or brand of the vehicle and hit enter" required value="<?php echo $search; ?>">
				</div><!-- Search -->
			</form>

		<div class="Ad">
			<div class="Add">
				<img src="img/Essential-Guide-Starting-Food-Business-NewJersey-728x90.jpg">
				<img src="img/Mobile App CreativeApp Banner ad 728x90.png">
			</div>
		</div>

		<div class="Showroom">

			<div class="OurShowroom">
				<fieldset>

				<h1><i class="far fa-calendar-minus"></i>OUR SHOWROOM</h1>

				<?php
					$query = "SELECT * FROM rented_vehicles WHERE type_of_vehicle = 'Luxery' OR type_of_vehicle = 'Antique' ORDER BY post_id DESC";
					$result = mysqli_query($Connection, $query);

					// echo $query;
					// die();

						if ($result) {
							if(mysqli_num_rows($result) > 0){
							$i = 0;
								while ($data = mysqli_fetch_assoc($result)) {
									if($i<8){
										$kind = print_kind($data['kind_of_vehicle']);
										?><div class="Item">
											<img src="web_img/<?php echo($kind); ?>/<?php echo($data['kind_of_vehicle']); ?>/<?php echo($data['post_id']); ?>/<?php echo($data['front_side_img']); ?>" alt="Vehicl photo here">
											<h3><?php echo $data['vehical_name']; ?></h3>
											<p><?php echo $data['mnf_year']; ?></p>
											<p><?php echo $data['province']; ?> Province</p>
											<p><?php echo $data['district']; ?> District</p>
											<h3 style="color: yellow"><?php echo $data['price']; ?> /=<br><span style="color: #808080;">LKR per day</span></h3>
											<a href="singlevehicle.php?post_id=<?php echo($data['post_id']) ?>"><button type="submit" name="take_a_look">Take A Look</button></a>
										</div><!--Item--><?php
									}
									$i++;
								}
							}else{
								echo "<h3 style=\"padding: 10px 0 20px 0; text-align: center; color: #aaa; font-family: sans-serif;\">No Luxery or Antique vehicles are found</h3>";
							}
						}else{
							echo "Databade query failed";
						}
				?>

					<!-- <div class="Item">
						<img src="img/car2.png" alt="Vehicl photo here">
						<h3>Vehical Name</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor.</p>
						<button type="submit" name="take_a_look">Take A Look</button>
					</div> --><!--Item-->
					<!-- <div class="Item">
						<img src="img/car2.png" alt="Vehicl photo here">
						<h3>Vehical Name</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor.</p>
						<button type="submit" name="take_a_look">Take A Look</button>
					</div> --><!--Item-->
					<!-- <div class="Item">
						<img src="img/car2.png" alt="Vehicl photo here">
						<h3>Vehical Name</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor.</p>
						<button type="submit" name="take_a_look">Take A Look</button>
					</div> --><!--Item-->

			</fieldset>
			</div>
			
		</div><!--Showroom-->

		<div class="Asc">
			<div class="Desc">
				<div class="Upper">
					<p>A big thank you to Tripplin-Rent-A-Car for the beyond satisfactory help with my trip planning and airport drop and pick up! The moment I landed in BIA I was greeted with smiles – Sri Lanka the nation that forever smiles. I visited Sri Lanka with my fiancé and we were transported to the lively beach town of Unuwatuna, a slow but comfortable drive. The Unuwatuna bay beach was breathtaking at sunset and makes you feel like you’re in Hawaii but it’s a dozen times cheaper! Plenty of cafés, curios, hotels, lodgings and restaurants galore the streets suitable for everyone and anyone. We decided to settle at the Lavendish Beach Resort, on our first day we enjoyed a small but happening party by a cafe on the beach! Sri Lanka loves to party!! We loved every part of our trip and it’s all thanks to Tripplin for organising everything and total ease of mind!</p>
				</div><!-- Upper -->
			</div><!-- Desc -->
		</div><!-- Asc -->


		<div class="Whyus">
			<div class="Whyuscont">
				<h1>WHY CHOOSE US</h1>

				<div class="int"><h2><i class="fas fa-users-cog"></i></h2>
				<h4>24 hour break down service</h4></div>
				<div class="int"><h2><i class="fas fa-car-crash"></i></h2>
				<h4>Comprehensive insurance</h4></div>
				<div class="int"><h2><i class="fas fa-taxi"></i></h2>
				<h4>Backup vehicles in case of emergency</h4></div>
				<div class="int"><h2><i class="fas fa-child"></i></h2>
				<h4>Child Seats</h4></div>
				<div class="abc" style="clear: both; height: 1px;"></div>
			</div><!-- Whyuscont -->
		</div><!-- Whyus -->

		<div class="Lastdiv">
			<h1>FREE ASSISTANCE FOR OUR CLIENTS</h1>
			<p>Tripplin Rent-a-Car can assist the non resident renter, who does not have a Sri Lankan driving licence, to obtain a temporary license from the Automobile Association or Department of Motor Traffic oF Sri Lanka for the duration of his stay in Sri Lanka. This is a legal requirement and mandatory to drive a vehicle in Sri Lanka. Apart from the government fee, no other charges will be levied for this service. Baby seats also will be provided free of charge for the duration of the rental period.</p>
		</div><!-- Lastdiv -->
	<?php require_once('inc/ftr.php');?>
	<?php mysqli_close($Connection); ?>
</body>
</html>