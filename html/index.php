<?php include "includes/session_start.php" ?>

<!DOCTYPE HTML>

<html lang="en">

<?php include "includes/head.php" ?>
	
<link href="common/css/index.css" rel="stylesheet" type="text/css" />

<?php include "includes/head2.php" ?>

<body>
	
	<?php include "includes/content/header.php"?>
	
	<main class="innerwrap">
		
		<article>
			
			<section>

				<h1>Network Configuration Manager</h1>

				<div>

					<?php 

						if ($_SESSION['adminType'] == "Head Admin") 
						{
							include "includes/content/headMenu.php";
						}
					?>

					<div class="columns" id="secondcol">

						<h2>Site Admin Menu</h2>

						<a href="viewSwitches.php">Switches</a>

						<a href="viewConfigs.php">Switch Configurations</a>

                                                <a href="changePassword.php">Change Password</a>                                               

					</div>
		
				</div>

			</section>
			
			<?php echo "<p>".$_SESSION['message']."</p>"; ?>

		</article>
	</main>

	<?php include "includes/content/footer.php"; ?>
	
</body>

</html>

<?php include 'security/session_variables_reset.php'; ?>
