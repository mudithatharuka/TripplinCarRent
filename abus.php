<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Tripplin Car Rent</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="css/abus.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

	<?php require_once('inc/hdr.php'); ?>
	<div class="Absback">
		<div class="About_Us">

			<h1>About Us</h1>
			<p>

			Welcome to Tripplin Car Rent, your number one source for all type of Car Renting and Car Booking. We're dedicated to giving you the very best of Car Rentong & Booking facilities, with a focus on Fair price rates, Comfertable ride, Your protection & Safty, and Responsible service.
			<br>
			<br>
			<br>
			<br>

			<img class="im1" src="img/car-hire-app.jpg" alt="About_Us">
			<img class="im2" src="img/online-car-rental-system.jpg" alt="About_Us">

			<br>
			<br>
			<br>
			<br>
			Founded in 2018 by Mr.Muditha Batuwangala, Tripplin Car Rent has come a long way from its beginnings in Colombo. When Mr.Batuwangala first started out, his passion for eco-friendly safe trip experience drove them to find ways, do tons of research, etc. So that Tripplin Car Rent can offer you Best Rent Cars. We now serve customers all over country, and are thrilled that we're able to turn our passion into our own website.
			<br>
			<br>
			<br>
			<br>
			We hope you enjoy our service as much as we enjoy offering them to you. If you have any questions or comments, please don't hesitate to contact us.
			<br>
			<br>
			<br>
			<br>
			Sincerely,
			<br>
			<br>
			Muditha Batuwangala.
			<br>
			


			</p>

			<h1>*****</h1>
			<br>
			<br>
		</div>
	</div>

	<?php require_once('inc/ftr.php'); ?>
	<?php mysqli_close($Connection); ?>
</body>
</html>