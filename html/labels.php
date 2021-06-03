<?php include 'includes/session_start.php';

$cfgID = $_SESSION['cfg'];

?>

<!DOCTYPE HTML>

<html lang="en">

<?php
	include "includes/head.php";
   include "includes/head2.php";

	// require 'includes/dbconnection.php';

?>

<body>

    <?php include 'includes/content/header.php'; ?>   

    <main class="innerwrap">

       <article>
         
         <section>

	      	<h1>Label</h1>

	      	<div>
                
		 			<h2>Add Label</h2>

               <form action="includes/dupes.php" class="addform" id="labels" method="post">

		    			<div>

		       			<label for="labelName">Label Name:</label>

		       			<input id="labelName" maxlength="50" name="labelName" placeholder="label of the config..." type="text" />

		    			</div>

		    			<input id="page" name="page" type="hidden" value="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" />

		    			<?php echo "<input name='cfg' type='hidden' value='$cfgID' />"; ?>
                    
                  <input type="submit" value="Add" />

		 			</form>

               <div>

                  <form action="viewConfigs.php" id="goback">

                     <input type="submit" value="Go Back" />

                  </form>

               <div>
   
           </div>

		  	</section>

		   <section>

		      <div>
	                
			 		<h2>Edit Label</h2>

               <form action="includes/editLabel.php" class="addform" id="labels" method="post">

		    			<div>

		    				<select>
		    					<?php ?>
		    				</select>

		       			<label for="labelName">Label Name:</label>

		       			<input id="labelName" maxlength="50" name="labelName" placeholder="label of the config..." type="text" />

		    			</div>

		    			<input id="page" name="page" type="hidden" value="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" />

		    			<?php echo "<input name='cfg' type='hidden' value='$cfgID' />"; ?>
                    
                  <input type="submit" value="Add" />

		 			</form>

               <div>

                  <form action="viewConfigs.php" id="goback">

                  	<input type="submit" value="Go Back" />

                  </form>

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
