<footer class="outerwrap">

	<div class="innerwrap">

		<div>
			
			<div id="dateandtime">

				<?php

					echo "<p>Date: <span id='date'>".date("m/d/Y")."</span></p>";

					echo "<p>Time: <span id='time'>".date("h:i A")."</span></p>";

				?>

			</div>

			<div>
				
				<p>&copy; <?php echo date("Y");?></p>

			</div>

		</div>

		<div>

			<?php

				if (isset($_SESSION['username']))
				{
					echo "<p>Hello, ".$_SESSION['username']."</p>";

					echo '<p><a href="includes/logoff.php">Log Out</a></p>';
				}
				else 
				{
					echo '<p><a href="login.php">Log In</a></p>';
				}

			?>

		</div>

	</div>

</footer>

<script>

	getCurrentTime();
						
	setInterval('getCurrentTime()', 1000);

</script>
