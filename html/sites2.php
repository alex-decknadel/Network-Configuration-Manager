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

				<h1>Sites</h1>

				<div>

					<h2>Add Sites</h2>
					
					<form action="includes/dupes.php" class="addform" id="sites" method="post">

						<div>
							
							<label for="siteName">Site Name:</label>

							<input id="siteName" maxlength="50" name="siteName" placeholder="Name of site..." type="text" required />
						
						</div>

						<input id="page" name="page" type="hidden" value="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" />

						<input type="submit" value="Add" />

					</form>

				</div>

			</section>

			<section>

				<h2>Existing Sites</h2>
				
				<div class="table">
					
					<div class="tableheader">

						<p class="tfirstcol">Site Name</p>

						<p class="tmidcol">Site Admin</p>

						<p class="tlastcol">Actions</p>

					</div>

					<?php include 'includes/content/tables/listSitestest.php'; ?>
					
				</div>

			</section>

			<?php echo '<p class="tMessage">'.$_SESSION['message'].'</p>'; ?>

		</article>

	</main>

	<?php include 'includes/content/footer.php'; ?>
	
</body>

</html>

<?php include 'security/session_variables_reset.php'; ?>
