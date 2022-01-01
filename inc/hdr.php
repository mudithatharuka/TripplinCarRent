
	<div class="Wrapper">
			<div class="Top-Bar-resp">
			<div class="Top-Bar-resp-Links">
				<div class="Mob-head">
					<i class="fas fa-bars"></i>

					<?php

					if(isset($_SESSION['user_id'])){
						?>
					<div class="Profile-mob">
						
						<p>
							<?php  
								$query = "SELECT rented_post_id FROM booked_vehicles WHERE rented_user_id = '{$_SESSION['user_id']}' AND seen = 'no' ORDER BY post_id DESC";
								$result = mysqli_query($Connection, $query);

								if($result){
									$num_notifications = mysqli_num_rows($result);
									if($num_notifications > 0){
										$bac_color = 'red';
									}else{
										$bac_color = '#808080';
									}
								}else{
									echo "Database query failed";
								}
							?>
							<a href="income.php?notification=true" style="color: <?php echo $bac_color; ?>; font-family: sans-serif; font-weight: bold;">
								<?php
									if($num_notifications > 0){
										?><i class="fas fa-bell"></i><?php
									}else{
										?><i class="far fa-bell-slash"></i><?php
									}
								?>(<?php echo $num_notifications; ?>)
							</a>
							<a href="income.php?total_income=true"><span style="color: orange;"> <i class="fas fa-file-invoice-dollar"></i></span>
							</a>
							<a href="pfle.php" style="color: yellow; font-size: 25px;">
								<i class="fas fa-user-circle"></i>
							</a>
						</p>

					</div>
						<?php

					}


					?>

				</div>
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li><a href="abus.php">ABOUT US</a></li>
					<li><a href="#">RULES & REDULATIONS</a></li>
					

					<?php

					if(isset($_SESSION['user_id'])){
						?>

						<li><a href="lgout.php">LOG OUT</a></li>
						
						<?php

					}else{
						?>
						<li><a href="login.php">LOG IN</a></li>
						<li><a href="reg.php">REGISTER</a></li>
						<?php
					}


					?>
				</ul>
				<style>
					.Top-Bar-resp { position: absolute; width: 100%; top: 0; }
					.Top-Bar-resp-Links { display: none; position: sticky; top: 0; padding: 0px 30px 5px 30px; background: rgba(0,0,0,0.9); }
					.Mob-head { padding: 20px 0px 30px 0px; width: 100%; }
					.Profile-mob { float: right; }
					.Profile-mob a { padding-left: 10px; }
					.fa-bars { color: #fff; float: left; }
					.Top-Bar-resp-Links ul {  height: 100%; }
					.Top-Bar-resp-Links ul li { padding: 10px 0px; width: 100%; }
					.Top-Bar-resp-Links ul li a { color: #fff; }

					@media screen and (max-width: 920px){
						.Top-Bar-resp-Links { display: block; }
						.Top-Bar { display: none; }
						.Top-Bar-Links ul, .Top-Bar-resp-Links ul {   /*border-radius: 0 0 20px 20px;*/ display: none; padding-bottom: 20px; }
					}
				</style>


			</div><!-- Top-Bar-resp-Links -->
		</div><!-- Top-Bar-resp -->

		<div class="Top-Bar clearfix">


			<div class="Top-Bar-Links">
				<ul>
					<li><a href="index.php">HOME</a></li>
					<li><a href="abus.php">ABOUT US</a></li>
					<li><a href="#">RULES & REDULATIONS</a></li>
					

					<?php

					if(isset($_SESSION['user_id'])){
						?>

						<li><a href="lgout.php">LOG OUT</a></li>
						
						<?php

					}else{
						?>
						<li><a href="login.php">LOG IN</a></li>
						<li><a href="reg.php">REGISTER</a></li>
						<?php
					}


					?>


				</ul>
			</div><!--Top-Bar-Links-->

			<?php

			if(isset($_SESSION['user_id'])){
				?>
			<div class="Profile">
				
				<p>
					<a href="pfle.php">
						WELCOME <?php echo strtoupper($_SESSION['first_name'] ); ?>!
					</a>
					<a href="income.php?total_income=true"><span style="color: orange;"> <i class="fas fa-file-invoice-dollar"></i></span>
					</a>
					<?php  
						$query = "SELECT rented_post_id FROM booked_vehicles WHERE rented_user_id = '{$_SESSION['user_id']}' AND seen = 'no' ORDER BY post_id DESC";
						$result = mysqli_query($Connection, $query);

						if($result){
							$num_notifications = mysqli_num_rows($result);
							if($num_notifications > 0){
								$bac_color = 'red';
							}else{
								$bac_color = '#808080';
							}
						}else{
							echo "Database query failed";
						}
					?>
					<a href="income.php?notification=true" style="color: <?php echo $bac_color; ?>; font-family: sans-serif; font-weight: bold;">
						<?php
							if($num_notifications > 0){
								?><i class="fas fa-bell"></i><?php
							}else{
								?><i class="far fa-bell-slash"></i><?php
							}
						?>(<?php echo $num_notifications; ?>)
					</a>
				</p>

			</div>
				<?php

			}


			?>

		</div><!--Top-Bar-->
		<script>
			$(document).ready(function(){
				$('.fa-bars').click(function(){
					$('.Top-Bar-resp-Links ul').slideToggle();
				});
			});
		</script>