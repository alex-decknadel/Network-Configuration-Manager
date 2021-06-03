<?php
	include 'includes/session_start.php';

	$previousPage = $_SESSION['page'];
	$currSwitch = $_SESSION['switch'];
	$currSwitchName = $_SESSION['switchName'];
	$currSiteName = $_SESSION['siteName'];
?> 

<!DOCTYPE HTML>

<html lang="en">

<?php 

	include 'includes/head.php';
	include 'includes/head2.php';
?>

<body>
	
	<?php include 'includes/content/header.php'; ?>

	<main class="innerwrap">
		
		<article>
			
			<section>

				<h1>Edit Switch</h1>

				<div>

					<h2>Edit Information for <?php echo $currSwitchName; ?></h2>
					
					<form action="includes/update.php" class="addform" 
					id="addSwitch" method="post">

						<?php 

							require 'includes/dbconnection.php';

							$sql = "SELECT agentID FROM siteAgents ";
							$sql .= "WHERE siteName = '$currSiteName'";

							$rs = $conn->query($sql);

							if ($rs->num_rows == 1)
							{
								$row = $rs->fetch_assoc();

								$currSite= $row['agentID'];

								unset($rs, $sql);

								$sql = "SELECT * FROM switches ";
								$sql .= "WHERE switchID = $currSwitch ";
								$sql .= "AND switchName = '$currSwitchName' ";
								$sql .= "AND siteAgent = $currSite";

								$rs = $conn->query($sql);

								if ($rs->num_rows == 1)
								{
									$row = $rs->fetch_assoc();

									$connMode = $row['connectionMode'];
									$connMode = rtrim($connMode);

									$ipAddress = $row['ipAddress'];
									$ipAddress = rtrim($ipAddress);

									$authString = $row['authenticationString'];
									$authString = rtrim($authString);
								}

								$conn->close();
								unset($rs, $sql);
							}
						?>

						<div class="switchDiv">
												
							<div class="leftDiv">
							
								<label for="switchName">Switch Name:</label>

								<input id="switchName" maxlength="50" 
								name="switchName" type="text" 
								value="<?php echo $currSwitchName; ?>" required />

							</div>

							<div class="rightDiv">

								<label for="site">Site:</label>

								<select id="site" name="site" required>

									<?php 
										include 'includes/content/options/sites.php';
									?>

								</select>

							</div>

						</div>

						<div class="switchDiv">

							<div class="leftDiv">

								<label for="ipAddress">IP Address:</label>

								<input id="ipAddress" maxlength="15" name="ipAddress" 
								pattern="(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" 
								placeholder="255.255.255.255" type="text" 
								value="<?php echo $ipAddress; ?>" required />

							</div>

							<div class="rightDiv">
								
								<label for="connectionMode">Connection Mode:</label>

								<select id="connectionMode" name="connectionMode" required>
									
									<option disabled>Select a Connection Mode</option>
									
									<?php include 'includes/content/options/connectionTypes.php'; ?>

								</select>

							</div>

						</div>

						<div class="switchDiv">

							<div class="leftDiv">
								
								<label for="authentication">Authentication String:</label>

								<input id="authentication" maxlength="255" 
								name="authentication" type="password" 
								value="<?php echo $authString; ?>"/>

							</div>

							<div class="rightDiv">

								<label for="confirmAuth">Confirm String:</label>

								<input id="confirmAuth" maxlength="255" 
								name="confirmAuth" type="password" 
								value="<?php echo $authString; ?>" />

							</div>

						</div>

						<?php include 'includes/hiddenInputs.php'; ?>

						<input type="submit" value="Update" />

					</form>

					<script>						
						var auth = document.getElementById("authentication")
							, confirmAuth = document.getElementById("confirmAuth");

						function validateString(){
						  if(auth.value != confirmAuth.value) {
						    confirmAuth.setCustomValidity("Passwords Don't Match");
						  } else {
						    confirmAuth.setCustomValidity('');
						  }
						}

						auth.onchange = validateString;
						confirmAuth.onkeyup = validateString;
					</script>

				</div>

				<div>

					<form action="viewSwitches.php" id="goback">

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