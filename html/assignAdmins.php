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

				<h1>Assign Sites</h1>
				
				<form action="includes/assignAdmins.php" id="assign" method="post">

					<div class="table">
						
						<div class="tableheader">
							
							<p class="tfirstcol">Site</p>

							<p class="tlastcol">Site Admin</p>

						</div>

						<?php include 'includes/content/tables/sites.php'; ?>

					</div>

					<input type="submit" value="Submit">

				</form>

			</section>

			<?php echo '<p class="tMessage">'.$_SESSION['message'].'</p>'; ?>

		</article>

	</main>

	<?php include 'includes/content/footer.php'; ?>
	
</body>

</html>

<?php include 'security/session_variables_reset.php'; ?>