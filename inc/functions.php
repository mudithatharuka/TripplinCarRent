<script>
					function busButtonStyle() { 
						document.getElementsByClassName("bus")[0].style.backgroundColor = "#b479d9"; 
						document.getElementsByClassName("bus")[0].style.color = "#2e4044"; 

						document.getElementsByClassName("car")[0].style.backgroundColor = "#2e4044";
						document.getElementsByClassName("car")[0].style.color = "#f8c44c";

						document.getElementsByClassName("van")[0].style.backgroundColor = "#2e4044";
						document.getElementsByClassName("van")[0].style.color = "#3dbe62";

						document.getElementsByClassName("offroad")[0].style.backgroundColor = "#2e4044";
						// document.getElementsByClassName("offroad")[0].style.hover:backgroundColor = "#3db3d9";
						document.getElementsByClassName("offroad")[0].style.color = "#3db3d9";
					}

					function carButtonStyle() { 
						document.getElementsByClassName("bus")[0].style.backgroundColor = "#2e4044"; 
						document.getElementsByClassName("bus")[0].style.color = "#b479d9"; 

						document.getElementsByClassName("car")[0].style.backgroundColor = "#f8c44c";
						document.getElementsByClassName("car")[0].style.color = "#2e4044";

						document.getElementsByClassName("van")[0].style.backgroundColor = "#2e4044";
						document.getElementsByClassName("van")[0].style.color = "#3dbe62";

						document.getElementsByClassName("offroad")[0].style.backgroundColor = "#2e4044";
						document.getElementsByClassName("offroad")[0].style.color = "#3db3d9";
					}

					function vanButtonStyle() { 
						document.getElementsByClassName("bus")[0].style.backgroundColor = "#2e4044"; 
						document.getElementsByClassName("bus")[0].style.color = "#b479d9"; 

						document.getElementsByClassName("car")[0].style.backgroundColor = "#2e4044";
						document.getElementsByClassName("car")[0].style.color = "#f8c44c";

						document.getElementsByClassName("van")[0].style.backgroundColor = "#3dbe62";
						document.getElementsByClassName("van")[0].style.color = "#2e4044";

						document.getElementsByClassName("offroad")[0].style.backgroundColor = "#2e4044";
						document.getElementsByClassName("offroad")[0].style.color = "#3db3d9";
					}

					function offroadButtonStyle() { 
						document.getElementsByClassName("bus")[0].style.backgroundColor = "#2e4044"; 
						document.getElementsByClassName("bus")[0].style.color = "#b479d9"; 

						document.getElementsByClassName("car")[0].style.backgroundColor = "#2e4044";
						document.getElementsByClassName("car")[0].style.color = "#f8c44c";

						document.getElementsByClassName("van")[0].style.backgroundColor = "#2e4044";
						document.getElementsByClassName("van")[0].style.color = "#3dbe62";

						document.getElementsByClassName("offroad")[0].style.backgroundColor = "#3db3d9";
						document.getElementsByClassName("offroad")[0].style.color = "#2e4044";
					}
				</script>


	<?php

		function bgc($tab){
			switch ($tab) {
				case 'rented_cars':
					$bgc = "#f8c44c";
					break;
				case 'rented_vans':
					$bgc = "#3dbe62";
					break;
				case 'rented_busses':
					$bgc = "#b479d9";
					break;
				case 'rented_off_roads':
					$bgc = "#3db3d9";
					break;
				
				default:
					$bgc = "#808080";
					break;
			}
			return $bgc;
		}


		function status($status){
			switch ($status) {
				case 'pending':
					$rowcol = "#3398dc";
					break;
				case 'confirmed':
					$rowcol = "#f39c11";
					break;
				case 'returned':
					$rowcol = "#00bc8c";
					break;
				case 'deleted':
					$rowcol = "#e84c3d";
					break;
				
			}
			
			return $rowcol;
		}


		function print_kind($kind){

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
				
			}

			return $print;

		}

		function check_req_fields($req_fields){
		//Check required fields
		$errors = array();

		foreach ($req_fields as $field) {
			if(empty(trim($_POST[$field]))){
			$errors[] = $field .' is required';
			}		
		}

		return $errors;
		}

		function check_date_validity($pick_d, $return_d){
			$errors = array();
			$today = date("Y-m-d");
			$picking = $pick_d;
			$returning = $return_d;

			$td = strtotime($today);
			$pd = strtotime($picking);
			$rd = strtotime($returning);

			if($pd < $td){
				$errors[] = 'Picking date cannot be a day before today.';
			}else if($rd <= $pd){
				$errors[] = 'Returning date cannot a be day before or same as picking date.';
			}else{
				$diff = $rd - $pd;
				$difference = abs(floor($diff / (60 * 60 * 24)));

				if($difference > 14){
					$errors[] = "Number of days must be less than 14. You have selected ".$difference." days.";
				}
			}

			return $errors;
		}

		function display_errors($errors){
		//Format and display the errors
		echo '<div class="errmsg">';
		echo "<b>There were error(s) in your form.</b><br>";
		foreach ($errors as $error) {
			$error = str_replace("_", " ", $error);
			$error = str_replace("currentp", "current password", $error);
			$error = str_replace("newp", "new password", $error);
			$error = str_replace("retypep", "retype password", $error);
			$error = str_replace("p ", "post ", $error);
			$error = str_replace("pick ", "picking date ", $error);
			$error = str_replace("return ", "returning date ", $error);
			$error = ucfirst($error); 
			echo '- '.$error .'<br>';
		}
		echo "</div>";
	}


	?>