<?php require_once('inc/Connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php session_start(); ?>
<?php
	//Checking if the user logged in
	$_SESSION['has_logged'] ='';
	if(!isset($_SESSION['user_id'])){
		$_SESSION['has_logged'] = 'no';
		header('Location: login.php');

	}

?>

<?php



	if(isset($_GET['post_id'])){
		$p_id = mysqli_real_escape_string($Connection, $_GET['post_id']);

		if(isset($_GET['category']) && $_GET['category'] =='booked'){
			$query = "SELECT * FROM booked_vehicles WHERE post_id = '{$p_id}' AND is_deleted_by_user = 0 AND booked_user_id = '{$_SESSION['user_id']}' AND status != 'deleted'  LIMIT 1";
		}else if(isset($_GET['category']) && $_GET['category'] =='rented'){
			$query = "SELECT * FROM rented_vehicles WHERE post_id = '{$p_id}' AND is_deleted = 0 AND user_id = '{$_SESSION['user_id']}' LIMIT 1";
		}else{
			header('Location:pfle.php?category=false');
		}

		$result_set = mysqli_query($Connection, $query);

		if($result_set){
			if(mysqli_num_rows($result_set) == 1){
				//Record found
				//Deleting the movie
				if(isset($_GET['category']) && $_GET['category'] =='booked'){
					$query = "UPDATE booked_vehicles SET is_deleted_by_user = 1 WHERE post_id = '{$p_id}' LIMIT 1";
				}else if(isset($_GET['category']) && $_GET['category'] =='rented'){
					$query = "UPDATE rented_vehicles SET is_deleted = 1 WHERE post_id = '{$p_id}' LIMIT 1";
				}

				$result = mysqli_query($Connection, $query);

				if($result){
					//Record deleted
					header('Location:pfle.php?record_deleted=true');
				}else{
					header('Location:pfle.php?record_deleted=false');
				}

			}else{
				//Record not found
				header('Location:pfle.php?record_found=false');
			}
		}else{
			//Query unsuccessful
			header('Location:pfle.php?query_successful=false');
		}
		
	}else{
		header('Location:pfle.php?post_id=false');
	}
	 
	

	
?>


<?php mysqli_close($Connection); ?>