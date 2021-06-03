<?php
session_start();
require 'dbconnection.php';


	if(isset($_POST['password']) && isset($_POST['user']))
	{
	  try
	  {	  
		
		$newpassword = $_POST['password'];
                $user = $_POST['user'];

		$sql = "SELECT * FROM admins WHERE username = '$user'";
		$rs = $conn->query($sql);

		if($rs->num_rows == 1)
		{
			$row = $rs->fetch_assoc();
			$oldpassword = $row['password'];	
		}
		unset($rs,$sql);

		if($newpassword != $oldpassword){

		   $sql = "UPDATE admins SET password = '$newpassword' WHERE username='$user'";
		   $rs = $conn->query($sql);
		   $_SESSION['message'] = "Update Successfully";

		}else{
			
		    $_SESSION['message'] = "Don't input same password as the original one";
		}


		$conn->close();
		unset($rs, $sql, $conn);
		header('Location: ../changePassword.php');
		exit();

	  }
          catch (Exception $e)
          { 
	      $_SESSION['message'] = 'An error has occurred during submission.';

	      // Close the connection
	      $conn->close();
	      unset($rs, $conn);

	      header('Location: ../changePassword.php');
	      exit();
           }  
         	  
	}else
	{
		try
		{
			$_SESSION['message'] = "Nothing Added because of missing data.";
			header('Location: ../changePassword.php');
			exit();
		}
		catch (Exception $e)
		{
			$_SESSION['message'] = "Problem redirecting to previous page.";
			header('Location: index.php');
			exit();
		}
	}

?>
