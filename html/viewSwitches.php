<?php include 'includes/session_start.php'; ?> 

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

				<h1>View Switches</h1>

				<div>

					<h2>Add Switch to Site</h2>
					
					<form action="includes/dupes.php" class="addform" 
					id="addSwitch" method="post">

						<div class="switchDiv">
												
							<div class="leftDiv">
							
								<label for="switchName">Switch Name:</label>

								<input id="switchName" maxlength="50" 
								name="switchName" type="text" required />

							</div>

							<div class="rightDiv">

								<label for="site">Site:</label>

								<select id="site" name="site" required>

									<?php include 'includes/content/options/sites.php'; ?>

								</select>

							</div>

						</div>

						<div class="switchDiv">
							
							<div class="leftDiv">

								<label for="ipAddress">IP Address:</label>

								<input id="ipAddress" maxlength="15" name="ipAddress" 
								pattern="(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$" 
								placeholder="255.255.255.255" type="text" required />

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
								name="authentication" type="password" />

							</div>

							<div class="rightDiv">

								<label for="confirmAuth">Confirm String:</label>

								<input id="confirmAuth" maxlength="255" 
								name="confirmAuth" type="password" />

							</div>

						</div>

						<input name="page" type="hidden" 
						value="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" />

						<input type="submit" value="Add" />

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

			</section>

			<section>

				<h2>Existing Switches</h2>
				
				<div class="table" id="switchTable">
					
					<div class="tableheader">

						<p class="tfirstcol">Switch</p>

						<p class="tmidcol">Site</p>

						<p class="tlastcol">IP Address</p>

						<p class="tlastcol">Connection</p>

						<p class='tlastcol'>Actions</p>

					</div>

					<?php include 'includes/content/tables/switches.php'; ?>

				</div>

			</section>

			<?php echo '<p class="tMessage">'.$_SESSION['message'].'</p>'; ?>

		</article>

	</main>

	<?php include 'includes/content/footer.php'; ?>
</body>

</html>

<?php include 'security/session_variables_reset.php'; ?>
