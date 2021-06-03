<?php

session_start();

require 'dbconnection.php';

	if(isset($_POST['labelName']) && isset($_POST['cfg']))
	{
	  try
	  {	  
		
		$cfgID = $_POST['cfg'];
	
		$label = $_POST['labelName'];

		$sql = "SELECT * FROM labels WHERE switchConfig = $cfgID";
		$rs = $conn->query($sql);

		//if($rs->num_rows == 0)
		//{
		//	unset($sql);
		//	$sql = "INSERT INTO labels('labelName','switchConfig') VALUES ('$label','$cfgID')";
		//}
		//{
			//$row = $rs->fetch_assoc();
			//$oldLabel = $row['labelName'];
		//}

		//$conn->close();
		//unset($rs, $sql, $conn);
		$_SESSION['message'] = $cfgID;
		header('Location: ../labels.php');
		exit();

	  }
          catch (Exception $e)
          { 
	      $_SESSION['message'] = 'An error has occurred during submission.';

	      // Close the connection
	      $conn->close();
	      unset($rs, $conn);

	      header('Location: ../labels.php');
	      exit();
           }  
         	  
	}else
	{
		try
		{
			$_SESSION['message'] = "Nothing Added because of missing data.";
			header('Location: ../labels.php');
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
