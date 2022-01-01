		<div class="Final">

			<div class="Home-Col">
				<h1>Quick links</h1>
					<div class="Quick-Links">
						
						<a href="index.php">Home</a>
						<a href="#">Frequenrly Ask Questions</a>
						<a href="#">How to use the website</a>
						<a href="pvplcy.php">Privacy policy</a>
						<a href="#">Sugessionsn & Complains</a>
						<a href="#">Your experiance of our service</a>

					</div><!--Quick-Links-->
			</div><!--Home-Col-->


			<div class="Home-Col">
				<h1>Some of our services</h1>
				
				<div class="Services">
					<img src="img/icons/taxi-car-rental-computer-icons-rent-png-clip-art-removebg-preview1.png" alt="Service">
					<h3>Service Name</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</p>
					<a href="#">Read More &raquo;</a>
				</div><!--Service-->

				<div class="Services">
					<img src="img/icons/car-wash-icon-png-7-removebg-preview.png" alt="Service">
					<h3>Service Name</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do</p>
					<a href="#">Read More &raquo;</a>
				</div><!--Service-->


			</div><!--Home-Col-->


			<div class="Home-Col">
				<div class="Contact-us">
					
				<h1>Contact us</h1>
				<p>
					<label>Name<span style="color: red;">*</span>:</label>
					<input type="text" name="name" placeholder="Enter your name">
				</p>
				<p>
					<label>Email<span style="color: red;">*</span>:</label>
					<input type="email" name="email" placeholder="Enter your email">
				</p>
				<p>
					<label>Message<span style="color: red;">*</span>:</label>
					<textarea placeholder="Enter the message" name="message"></textarea>
				</p>
				<p><button name="send">Send</button></p>
				<style type="text/css">
					.Home-Col p { padding: 20px 15px; }
					.Home-Col p label { float: left; width: 90px; }
					.Home-Col p input, .Home-Col p textarea { width: 180px; padding: 5px 10px; background-color: transparent; border: none; border-bottom: 1px solid #fff; color: #fff; font-family: sans-serif; }
					.Home-Col p button { border-radius: 10px; font-weight: bold; padding: 5px 20px; background-color: orange; font-family: sans-serif; border: none; }
					.Home-Col p button:hover { cursor: pointer; }
				</style>
				</div><!-- Contact-us -->
			</div><!--Home-Col-->


			<div class="Home-Col">
				<h1>Follow us on</h1>
				<div class="Final-Social-Media">
				<ul>
					<li><a href="#"><i class="fab fa-linkedin fa-fw"></i></a></li>
					<li><a href="#"><i class="fab fa-twitter fa-fw"></i></a></li>
					<li><a href="#"><i class="fab fa-pinterest fa-fw"></i></a></li>
					<li><a href="#"><i class="fab fa-facebook fa-fw"></i></a></li>
					<li><a href="#"><i class="fas fa-rss fa-fw"></i></a></li>
				</ul>
				</div><!--Social-Media-->
			</div><!--Home-Col-->

		</div><!--Final-->

	</div><!--Wrapper-->

	<style>
		@media screen and (max-width: 920px){
			.Home-Col{
				width: 33%;
				margin: 0 8%;
			}
		}
		@media screen and (max-width: 435px){
			.Home-Col{
				width: 66%;
				float: none;
				margin: 20px auto;
				padding: 10px 0;
				align-items: center;
			}
			.Quick-Links{
				text-align: center;
				align-items: center;
			}
			.Quick-Links a{
				float: none;
				display: block;
				margin: 5px 0;
			}
			.Final-Social-Media{
				text-align: center;
			}
		}
		@media screen and (max-width: 330px) {
			.Final-Social-Media ul li a{
				padding: 5px;			
			}
		}
	</style>