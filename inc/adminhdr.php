<?php
	if(!isset($_SESSION['admin_id'])){
		header("Location:adminlogin.php?login=false");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>


	<style type="text/css">
		* { margin: 0; padding: 0; }
		.clearfix{ overflow: auto; }
		a { text-decoration: none; transition-duration: .30s; }
		button { transition-duration: .40s; }

		header { background-color: #eee; position: sticky; top: 0; }
		header h1 { float: left; padding: 20px 30px; }
		header p { float: right; padding: 20px 30px; font-size: 19px; }
		header p button { font-weight:bold; padding: 8px 35px; border-radius: 20px; color: #e44e5c; font-family: sans-serif; border: 2px solid #e44e5c; background-color: #2e4044 }
		header p button:hover { background-color: #e44e5c; cursor: pointer; color: #2e4044; }

		@media screen and (max-width: 750px) {
			header h1 { float: none; text-align: center; }
			header p { float: none; text-align: center;}
		}

	</style>

</head>
<body>

	<header class="clearfix">
			<a href="adminhome.php" style="color: #000;"><h1>Tripplin Car Rent</h1></a>
			<p>Welcome Admin <b ><?php echo $_SESSION['username']; ?></b>! <a href="admins.php"><button style="padding: 8px 12px;">A</button></a> <a href="adminlogout.php"><button>Logout</button></a></p>
	</header>

</body>
</html>