<?php session_start(); ?>
<?php require_once('inc/Connection.php'); ?>
<?php
	//Checking if the user logged in
	$_SESSION['has_logged'] ='';
	if(!isset($_SESSION['user_id'])){
		$_SESSION['has_logged'] = 'no';
		header('Location: login.php');

	}

?>
<?php

	$full_name = '';
	$province = '';
	$district = '';
	$vehicle_name = '';
	$brand_name = '';
	$kind = '';
	$type = '';
	$manufacture_year = '';
	$condition = '';
	$description = '';
	$contactno = '';
	$price = '';
	$phone_code = '';
	$nic = '';
	$email = '';

	if(isset($_POST['submit'])){

		$full_name = $_POST['full_name'];
		$province = $_POST['province'];
		$district = $_POST['district'];
		$vehicle_name = $_POST['vehicle_name'];
		$brand_name = $_POST['brand_name'];
		$kind = $_POST['kind'];
		$type = $_POST['type'];
		$manufacture_year = $_POST['manufacture_year'];
		$condition = $_POST['condition'];
		$description = $_POST['description'];
		$contactno = $_POST['contactno'];
		$price = $_POST['price'];
		$phone_code = $_POST['phone_code'];
		$nic = $_POST['nic'];
		$email = $_POST['email'];

		$user_id = $_SESSION['user_id'];
		$email_in_db = $_SESSION['email'];
		$phone_number_in_db = $_SESSION['phone_number'];
		$phone_code_in_db = $_SESSION['phone_code'];
		$nic_in_db = $_SESSION['nic'];
		$errors = array();
		$noimage = array();
		$differen_email_phone_nic = array();


		if(!isset($_POST['full_name']) || strlen(trim($_POST['full_name'])) < 1 ){
			$errors[]= 'full_name is missing or invalid';
		}
		if(!isset($_POST['province']) || strlen(trim($_POST['province'])) < 1 ){
			$errors[]= 'province is missing or invalid';
		}
		if(!isset($_POST['district']) || strlen(trim($_POST['district'])) < 1 ){
			$errors[]= 'district is missing or invalid';
		}
		if(!isset($_POST['vehicle_name']) || strlen(trim($_POST['vehicle_name'])) < 1 ){
			$errors[]= 'vehicle_name is missing or invalid';
		}
		if(!isset($_POST['brand_name']) || strlen(trim($_POST['brand_name'])) < 1 ){
			$errors[]= 'brand_name is missing or invalid';
		}
		if(!isset($_POST['kind']) || strlen(trim($_POST['kind'])) < 1 ){
			$errors[]= 'kind is missing or invalid';
		}
		if(!isset($_POST['type']) || strlen(trim($_POST['type'])) < 1 ){
			$errors[]= 'type is missing or invalid';
		}
		if(!isset($_POST['manufacture_year']) || strlen(trim($_POST['manufacture_year'])) < 1 ){
			$errors[]= 'manufacture_year is missing or invalid';
		}
		if(!isset($_POST['condition']) || strlen(trim($_POST['condition'])) < 1 ){
			$errors[]= 'condition is missing or invalid';
		}
		if(!isset($_POST['description']) || strlen(trim($_POST['description'])) < 1 ){
			$errors[]= 'description is missing or invalid';
		}
		if(!isset($_POST['price']) || strlen(trim($_POST['price'])) < 1 ){
			$errors[]= 'price is missing or invalid';
		}
		if(!isset($_POST['contactno']) || strlen(trim($_POST['contactno'])) < 1 ){
			$errors[]= 'contactno is missing or invalid';
		}else{
			$check_phone = mysqli_real_escape_string($Connection,$_POST['contactno']);

			if( $check_phone != $phone_number_in_db ){
				$differen_email_phone_nic[] = 'Contact is different';
			}
		}
		if(!isset($_POST['phone_code'])){
			$errors[]= 'phone_code is missing or invalid';
		}else{
			$check_phone_code = $_POST['phone_code'];

			if( $check_phone_code != $phone_code_in_db ){
				$differen_email_phone_nic[] = 'Contact is different';
			}
		}
		if(!isset($_POST['nic']) || strlen(trim($_POST['nic'])) < 1 ){
			$errors[]= 'nic is missing or invalid';
		}else{
			$check_nic = mysqli_real_escape_string($Connection,$_POST['nic']);

			if( $check_nic != $nic_in_db ){
				$differen_email_phone_nic[] = 'NIC is different';
			}
		}
		if(!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ){
			$errors[]= 'email is missing or invalid';
		}else{
			$check_email = mysqli_real_escape_string($Connection,$_POST['email']);

			if( $check_email != $email_in_db ){
				$differen_email_phone_nic[] = 'Email is different';
			}
		}
		if($_FILES['file1']['name'] == ''){
			$noimage[]= 'file1 is missing or invalid';
		}
		if($_FILES['file2']['name'] == ''){
					$noimage[]= 'file2 is missing or invalid';
				}
		if($_FILES['file3']['name'] == ''){
					$noimage[]= 'file3 is missing or invalid';
				}
		if($_FILES['file7']['name'] == ''){
					$noimage[]= 'file7 is missing or invalid';
				}
		if($_FILES['file4']['name'] == ''){
					$noimage[]= 'file4 is missing or invalid';
				}
		if($_FILES['file6']['name'] == ''){
					$noimage[]= 'file6 is missing or invalid';
				}
		if($_FILES['file5']['name'] == ''){
					$noimage[]= 'file5 is missing or invalid';
				}
		if($_FILES['file8']['name'] == ''){
					$noimage[]= 'file8 is missing or invalid';
				}



		if(empty($errors) && empty($differen_email_phone_nic) && empty($noimage)){
			$full_name = mysqli_real_escape_string($Connection,$_POST['full_name']);
			$province = mysqli_real_escape_string($Connection,$_POST['province']);
			$district = mysqli_real_escape_string($Connection,$_POST['district']);
			$vehicle_name = mysqli_real_escape_string($Connection,$_POST['vehicle_name']);
			$brand_name = mysqli_real_escape_string($Connection,$_POST['brand_name']);
			$kind = $_POST['kind'];
			$type = $_POST['type'];
			$manufacture_year = mysqli_real_escape_string($Connection,$_POST['manufacture_year']);
			$condition = mysqli_real_escape_string($Connection,$_POST['condition']);
			$description = mysqli_real_escape_string($Connection,$_POST['description']);
			$phone_number = mysqli_real_escape_string($Connection,$_POST['contactno']);
			$price = mysqli_real_escape_string($Connection,$_POST['price']);
			$phone_code = $_POST['phone_code'];
			$nic = mysqli_real_escape_string($Connection,$_POST['nic']);
			$email = mysqli_real_escape_string($Connection,$_POST['email']);

			$profit = $price*0.25;

			$table = '';
			$print = '';

			$query = "SELECT * FROM rented_vehicles ORDER BY post_id DESC LIMIT 1";
			$result_set = mysqli_query($Connection, $query);

			if($result_set){
				if(mysqli_num_rows($result_set) == 1){
					//Last post_id retrived 
					$post = mysqli_fetch_assoc($result_set);
					$id = $post['post_id'];
					$id++;
					
					$post_id = $id;
					
				}else{
					$id = 1;
					$post_id = $id;
				}
			}else{
				$errors[] = 'Retriving last post_id database query faild';
			}

			
			switch ($kind) {
				case 'Hatchback':
				case 'Wagon':
				case 'Sedan':
				case 'Coupe':
				case 'Sport':
					$table = 'rented_cars';
					$print = 'Cars';
					break;

				case 'Off Road':
				case 'Pickup':
				case 'SUV':
					$table = 'rented_off_roads';
					$print = 'Off Road and Jeeps';
					break;
				case 'Van':
					$table = 'rented_vans';
					$print = 'Vans';
					break;
				case 'Bus':
					$table = 'rented_busses';
					$print = 'Busses';
					break;
				default:
					
					break;
			}

			//Maked a folder to store photos with post_id
			$curdir = getcwd();
			mkdir($curdir."/web_img/{$print}/{$kind}/".$post_id, 0777);	


			$target1 = "web_img/{$print}/{$kind}/{$post_id}/".basename($_FILES['file1']['name']);
			$target2 = "web_img/{$print}/{$kind}/{$post_id}/".basename($_FILES['file2']['name']);
			$target3 = "web_img/{$print}/{$kind}/{$post_id}/".basename($_FILES['file3']['name']);
			$target4 = "web_img/{$print}/{$kind}/{$post_id}/".basename($_FILES['file4']['name']);
			$target5 = "web_img/{$print}/{$kind}/{$post_id}/".basename($_FILES['file5']['name']);
			$target6 = "web_img/{$print}/{$kind}/{$post_id}/".basename($_FILES['file6']['name']);
			$target7 = "web_img/{$print}/{$kind}/{$post_id}/".basename($_FILES['file7']['name']);
			$target8 = "web_img/{$print}/{$kind}/{$post_id}/".basename($_FILES['file8']['name']);

			$file1 = $_FILES['file1']['name'];
			$file2 = $_FILES['file2']['name'];
			$file3 = $_FILES['file3']['name'];
			$file4 = $_FILES['file4']['name'];
			$file5 = $_FILES['file5']['name'];
			$file6 = $_FILES['file6']['name'];
			$file7 = $_FILES['file7']['name'];
			$file8 = $_FILES['file8']['name'];
			

			$query = "INSERT INTO rented_vehicles(user_id, full_name, province, district, vehical_name, brand_name, kind_of_vehicle, type_of_vehicle, mnf_year, vehicle_condition, description, phone_code, contact_no, nic, email, front_side_img, rear_side_img, side_view_img, f_compartment_img, r_compartment_img, d_compartment_img, e_compartment_img, extra_wheel_img, price, profit, tab) VALUES ('{$user_id}','{$full_name}','{$province}','{$district}','{$vehicle_name}','{$brand_name}','{$kind}','{$type}','{$manufacture_year}','{$condition}','{$description}','{$phone_code}','{$phone_number}','{$nic}','{$email}','$file1','$file2','$file3','$file4','$file5','$file6','$file7','$file8', '{$price}', '{$profit}', '{$table}')";
			// echo $query;
			// die();

			$result_set = mysqli_query($Connection, $query);

			if($result_set){
				//Query successful

				if(move_uploaded_file($_FILES['file1']['tmp_name'], $target1) && move_uploaded_file($_FILES['file2']['tmp_name'], $target2) && move_uploaded_file($_FILES['file3']['tmp_name'], $target3) && move_uploaded_file($_FILES['file4']['tmp_name'], $target4) && move_uploaded_file($_FILES['file5']['tmp_name'], $target5) && move_uploaded_file($_FILES['file6']['tmp_name'], $target6) && move_uploaded_file($_FILES['file7']['tmp_name'], $target7) && move_uploaded_file($_FILES['file8']['tmp_name'], $target8)){
					
				}else{
					$errors = 'Database query faild';
				}


			}else{
				$errors = 'Database query faild';
			}
		}

	}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Tripplin Car Rent</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
	<link rel="stylesheet" type="text/css" href="css/rntacr.css">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

	<?php require_once('inc/hdr.php'); ?>

		<div class="Content">

			<h1>Rent Your Vehicle</h1>

			<p>Rent your vehicle here in Tripplin Car Rent for a fair price, and don't foget to add your vehicle descriptions categories and other informations correctly. Otherwise your vehicle will not be apper to the users in the correct place. Hence you will not be recived a booking requests to your vehicle. 25% of commission will be charged from your price.</p>

			<div class="Blank">
				
			</div>

			<form action="rntacr.php" method="post" enctype="multipart/form-data">

						<?php

						if(isset($errors) && !empty($errors)){
								echo '<p class="error">Invalid Inputs or Some fields are Missing</p>';
						}elseif(isset($differen_email_phone_nic) && !empty($differen_email_phone_nic)){
								echo '<p class="error">The Email NIC or Phone Number You Entered Is Invalid</p>';
						}elseif(isset($noimage) && !empty($noimage)){
								echo '<p class="error">Please Select The Images of Your Vehicle</p>';
						}
						elseif(isset($errors) && empty($differen_email_phone_nic) && empty($noimage)){
								echo '<p class="noerror">Your Vehicle Was Successfully Rented</p>';
						}
						


						?>

						<h2 class="Topic">Name in full</h2>
						<input class="Name" type="text" placeholder="Full Name" name="full_name" <?php echo 'value="' .$full_name. '"'; ?>><br>

						<h2 class="Topic">Province</h2>
						<input class="Province" type="text" placeholder="Your Province" name="province" <?php echo 'value="' .$province. '"'; ?>><br>
						
						<h2 class="Topic">District</h2>
						<input class="District" type="text" placeholder="Your District" name="district" <?php echo 'value="' .$district. '"'; ?>><br>

						<h2 class="Topic">Name of the vehicle</h2>
						<input class="VehicleName" type="text" placeholder="Vehicle Name" name="vehicle_name" <?php echo 'value="' .$vehicle_name. '"'; ?>><br>

						<h2 class="Topic">Brand name of the vehicle</h2>
						<input class="BrandName" type="text" placeholder="Brand Name" name="brand_name"<?php echo 'value="' .$brand_name. '"'; ?>><br>

						<h2 class="Topic">Kind of the vehicle</h2>
						<select name ="kind" <?php echo 'value="' .$kind. '"'; ?>>
							<option>Hatchback</option>
							<option>SUV</option>
							<option>Off Road</option>
							<option>Pickup</option>
							<option>Wagon</option>
							<option>Van</option>
							<option>Sedan</option>
							<option>Coupe</option>
							<option>Sport</option>
							<option>Bus</option>
							
						</select><br>

						<h2 class="Topic">Type of the vehicle</h2>
						<select name ="type" <?php echo 'value="' .$type. '"'; ?>>
							<option>Luxery</option>
							<option>Normel</option>
							<option>Old</option>
							<option>Antique</option>
							
						</select><br>


						<h2 class="Topic">Manufacture year</h2>
						<input class="ManufactureYear" type="text" placeholder="Year" name="manufacture_year" <?php echo 'value="' .$manufacture_year. '"'; ?>><br>

						<h2 class="Topic">Condition</h2>
						<input class="Condition" type="text" placeholder="Condition" name="condition" <?php echo 'value="' .$condition. '"'; ?>><br>

						<h2 class="Topic">Little Description</h2>
						<input class="Description" type="text" placeholder="A Littele Descriptionabout the Vehicle" name="description" <?php echo 'value="' .$description. '"'; ?>><br>

						<h2 class="Topic">Renting Price</h2>
						<input class="Price" type="number" placeholder="Price [%25 will be charged for the firm]" name="price" <?php echo 'value="' .$price. '"'; ?>><br>

						<h2 class="Topic">Contact No</h2>
						<select name="phone_code" <?php echo 'value="' .$phone_code. '"'; ?>>
							<option>+91</option>
							<option>+92</option>
							<option>+93</option>
							<option>+94</option>
							<option>+95</option>
							<option>+96</option>
							<option>+97</option>
							<option>+98</option>
							<option>+99</option>
						</select>
						<input class="ContactNo" type="text" placeholder="Contact Number" name="contactno" <?php echo 'value="' .$contactno. '"'; ?>><br>

						<h2 class="Topic">NIC</h2>
						<input class="Nic" type="text" placeholder="National ID" name="nic" <?php echo 'value="' .$nic. '"'; ?>><br>

						<h2 class="Topic">E-mail</h2>
						<input class="Email" type="mail" placeholder="E-mail Address" name="email" <?php echo 'value="' .$email. '"'; ?>><br>

						<h2 class="Topic">Upload images</h2><br>

						<h4 class ="SubTopic">Front side</h4>
						<input class ="Photos" type="file" name="file1" id="file" accept="image/*"><br>

						<h4 class ="SubTopic">Rear side</h4>
						<input type="file" id="file" name="file2" accept="image/*"><br>

						<h4 class ="SubTopic">Side view</h4>
						<input type="file" id="file" name="file3" accept="image/*"><br>

						<h4 class ="SubTopic">Front compartment</h4>
						<input type="file" id="file" name="file4" accept="image/*"><br>

						<h4 class ="SubTopic">Rear compartment</h4>
						<input type="file" id="file" name="file5" accept="image/*"><br>

						<h4 class ="SubTopic">Dicky compartment</h4>
						<input type="file" id="file" name="file6" accept="image/*"><br>

						<h4 class ="SubTopic">Engine compartment</h4>
						<input type="file" id="file" name="file7" accept="image/*"><br>

						<h4 class ="SubTopic">Extra wheel</h4>
						<input type="file" id="file" name="file8" accept="image/*"><br>

						<button type="submit" name="submit" id="submit">RENT</button>


				</form>

			<div class="Blank">
				
			</div>

		</div><!--Content-->
		
	<?php require_once('inc/ftr.php'); ?>
	<?php mysqli_close($Connection); ?>

</body>

</html>

