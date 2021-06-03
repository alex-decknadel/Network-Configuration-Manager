<?php include 'includes/session_start.php';

$user = $_SESSION['username'];

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

	      <h1>Change Password</h1>

	      <div>
                
		 <h2></h2>

                 <form action="includes/updatePassword.php" class="addform" id="labels" method="post">

		    <div>

		       <label for="password">New Password</label>

		       <input id="password" maxlength="50" name="password" type="password" required />

		    </div>

                    <div>

                       <label for="confirm">Confirm Password:</label>

                       <input id="confirm" maxlength="100" name="confirm" type="password" required />

                    </div>

		    <input id="page" name="page" type="hidden" value="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" />

		    <?php echo "<input name='user' type='hidden' value='$user' />"; ?>
                    
                    <input type="submit" value="Update" />

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


                  <div>

                     <form action="index.php" id="goback">

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
