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

				<h1>Site Admins</h1>

				<div>

					<h2>Add Site Admins</h2>
					
					<form action="includes/dupes.php" class="addform" id="addAdmins" method="post">

						<div>
							
							<div class='adminDiv leftDiv'>

								<div>
								
									<label for="adminName">Username:</label>

									<input id="adminName" maxlength="50" name="adminName" type="text" required />

								</div>

								<div>

									<label for="email">Email:</label>

									<input id="email" maxlength="128" name="email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" placeholder="iphone@gmail.com" type="text" required />

								</div>

							</div>

							<div class='adminDiv rightDiv'>

								<div>

									<label for="password">Password:</label>

									<input id="password" maxlength="100" name="password" type="password" required />

								</div>

								<div>

									<label for="confirm">Confirm Password:</label>

									<input id="confirm" maxlength="100" name="confirm" type="password" required />

								</div>

							</div>

						</div>

						<input id="page" name="page" type="hidden" value="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" />

						<input type="submit" value="Add" />

					</form>

					<script>						
						var pwd = document.getElementById("password")
							, confirmPwd = document.getElementById("confirm");

						function validateString(){
						  if(pwd.value != confirmPwd.value) {
						    confirmPwd.setCustomValidity("Passwords Don't Match");
						  } else {
						    confirmPwd.setCustomValidity('');
						  }
						}

						pwd.onchange = validateString;
						confirmPwd.onkeyup = validateString;
					</script>

				</div>

			</section>

			<section>

				<h2>Existing Site Admins</h2>

                <div>

					<div class="table" id="adminTable">
					
						<div class="tableheader">

							<p class="tmidcol">Username</p>

							<p class="tlastcol">Email</p>

							<p class="tlastcol">Sites</p>

							<p class="tlastcol">Actions</p>

						</div>
                                          
						<?php include 'includes/content/tables/siteAdmins2.php'; ?>

					</div>
                             
                </div>

			</section>

			<?php echo '<p class="tMessage">'.$_SESSION['message'].'</p>'; ?>

		</article>

	</main>

	<?php include 'includes/content/footer.php'; ?>
	
</body>

</html>

<?php include 'security/session_variables_reset.php'; ?>
