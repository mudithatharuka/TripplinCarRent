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

	if(isset($_GET['post_id'])){
		$query = "SELECT * FROM booked_vehicles WHERE post_id = '{$_GET['post_id']}' LIMIT 1";
		$result = mysqli_query($Connection, $query);

		if($result){
			if(mysqli_num_rows($result) == 1){
				$query = "UPDATE booked_vehicles SET seen = 'yes' WHERE post_id = '{$_GET['post_id']}' LIMIT 1";
				$result = mysqli_query($Connection, $query);

				if($result){
					header("Location:income.php?notification=true&seen=successful");
				}else{
					header("Location:income.php?notification=true&seen=unsuccessful");
				}
			}else{
				header("Location:income.php?notification=true&post_id=error");
			}
		}else{
			header("Location:income.php?notification=true&query=failed");
		}
	}else{
		header("Location:income.php?notification=true&post_id=not_set");
	}

mysqli_close($Connection);
?>