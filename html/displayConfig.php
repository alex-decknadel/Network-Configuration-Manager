<?php include 'includes/session_start.php'; ?>

<!DOCTYPE HTML>

<html lang="en">

<?php 
	include "includes/head.php";
	include "includes/head2.php"; 

	require 'includes/dbconnection.php';
	require 'includes/displayFile.php';
?>

</head>

<body>
	
	<?php include 'includes/content/header.php'; ?>

	<main class="innerwrap">
		
		<article>
			
			<section>

				<h1>Display Configuration</h1>

				<div id="display">
					
					<?php
						if ($output != "No file here to read.")
						{
							foreach(preg_split("/((\r?\n)|(\r\n?))/", $output) as $line)
							{
								echo "<p>$line</p>";	
							}
						}
						else
						{
							echo "<p>$output</p>";
						}
					?>

				</div>


			        <div>

					<form action="viewConfigs.php" id="goback">

						<input type="submit" value="Go Back" />

					</form>

				</div>

			</section>

			<?php echo '<p class="tMessage">'.$_SESSION['message'].'</p>'; ?>

		</article>

	</main>

	<?php include 'includes/content/footer.php'; ?>

</body>

</html>

<?php include 'security/session_variables_reset.php'; ?>
