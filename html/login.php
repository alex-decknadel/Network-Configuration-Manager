<?php 
	session_start();

	$_SESSION['message'] = "";

	if (!isset($_SESSION['timedateRefreshCount']))
	{
		$_SESSION['timedateRefreshCount'] = 0;
	}

	if (isset($_SESSION['username']))
	{
		header('Location: index.php');
	}

?>

<!DOCTYPE HTML>

<html lang="en">

<?php include "includes/head.php"; ?>  

<link href="common/css/login.css" rel="stylesheet" type="text/css" />

<?php include "includes/head2.php"; ?>

<body>
	
	<?php include 'includes/content/header.php'; ?>

	<main class="innerwrap">
        
        <article>

        	<section>

        		<h1>Network Configuration Manager</h1>
        		
        		<form action="security/authorize.php" id="loginform" method="post">
            
            		<div>

            			<label>Username:</label>
            	
            			<input id="username" maxlength="50" name="username" type="text" required />

            		</div>
            	
            		<div>

            			<label>Password:</label>
            	
            			<input id="passwd" maxlength="100" name="passwd" type="password" required />

            		</div>

            		<input id="page" name="page" type="hidden" value="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" />
            
            		<input id="login" name="login" type="submit" value="Login" />

        		</form>

        		<?php echo '<p>'.$_SESSION['message'].'</p>'; ?>

        	</section>

        </article>
        
    </main>

	<?php include 'includes/content/footer.php'; ?>

</body>

</html>
