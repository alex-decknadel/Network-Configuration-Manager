<?php include 'includes/session_start.php'; ?>

<!DOCTYPE HTML>

<html lang="en">

<?php include 'includes/head.php'; ?>

	<link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap" rel="stylesheet" />

       	<script src="common/js/jquery-3.1.1.min.js" type="text/javascript"></script>
       	<script src="common/js/lib.js" type="text/javascript"></script>
       	<script src="common/js/updateTime.js" type="text/javascript"></script>

       	<script>

               	// Load jQuery and other Javascript after page is done loading
               	$( document.body ).ready(function () {

                       	$( "#mobilenav" ).click(function() {

                               	$( "#primary" ).slideToggle( "fast", function() {});

						});
                });

        </script>

</head>

<body>
	
	<?php include 'includes/content/header.php'; ?>

	<main class="innerwrap">
		
		<article>
			
			<section>

				<h1>Switch Configurations</h1>

				<div>

					<h2>Select Site</h2>
					
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="submitform" id="selectSite" method="post">
						
						<div>

							<label for="chooseSite">Site:</label>

							<?php 

								if (isset($_SESSION['chosenSite']))
								{
									echo "<select id='chooseSite' name='chooseSite' value='";
									echo $_SESSION['chosenSite']."' required>";
								}
								else
								{
									echo "<select id='chooseSite' name='chooseSite' required>";
								}

								include 'includes/content/options/sites.php';
							?>

							</select>

						</div>

						<input type="submit" value="Select" />

					</form>

				</div>

			</section>
			
			<section>

				<h2>Select Authoritative Configuration</h2>

				<div class="table" id="configTable">
					
					<div class="tableheader">

						<p class="tfirstcol">Switch / Config Label</p>
						                      
						<p class="tmidcol">Date &amp; Time</p>

						<p class="tmidcol">Authoritative?</p>

						<p class="tlastcol">Actions</p>                         

					</div>
					
					<?php include 'includes/content/tables/configs4.php'; ?>

				</div>

			</section>
			
			<section>

				<h2>Select Configuration to Compare to Authoritative</h2>

				<div>
					
					<form action="comparisons.php" class="submitform" id="selectConfig" method="post">
						
						<div>
							<label for="chooseSwitch">Switch:</label>
							
							<select onchange="getConfigs(this.value)" id="chooseSwitch" name="chooseSwitch" required>

								<option>Select Switch</option>

								<?php include 'includes/content/options/switches.php'; ?>

							</select>

						</div>

						<div>

							<label for="chooseConf">Configuration:</label>
							
							<select id="chooseConf" name="chooseConf" required>

								<option disabled>Select Configuration</option>

							</select>

							<script type="text/javascript">
								
								function getConfigs(val)
								{
									$.ajax({
										type: 'post',
										url: 'includes/content/options/configs.php',
										data: {
											get_option: val
										},
										success: function (response) {
											document.getElementById("chooseConf").innerHTML=response;
										}
									});
								}

							</script>

						</div>
						
						<input type="submit" value="Compare" />

					</form>

				</div>
				
			</section>

           <section>

                    <h2>Check Previous Configurations </h2>

                    <div>

                        <form action="listConfigs.php" class="submitform" id="selectPreConfigs" method="post">

                            <div>
                                    <label for="chooseSwitch">Switch:</label>

                                    <select onchange="getConfigs(this.value)" id="chooseSwitch" name="chooseSwitch" required>

                                            <option>Select Switch</option>

                                            <?php include 'includes/content/options/switches.php'; ?>

                                    </select>

                            </div>
                          	
                          	<input type="submit" value="View" />

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
