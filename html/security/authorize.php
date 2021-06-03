<?php
ob_start();
session_start(); 

try 
{
	if (isset($_POST['username']) && isset($_POST['passwd'])) 
	{	
		$username = $_POST['username'];
		$password = $_POST['passwd'];
		$authorized = false;
	}

	require '../includes/dbconnection.php';

	$sql = 'SELECT * FROM admins';

	$rs = $conn->query($sql);

	if ($rs->num_rows > 0)
	{	
		while ($row = $rs->fetch_assoc()) 
		{	
			$rowUser = $row["username"];
			$rowPassword = $row["password"];
			$rowType = $row["adminType"];
		//	$rowID = $row["adminID"];

			$rowUser = rtrim($rowUser);
			$rowPassword = rtrim($rowPassword);
			$rowType = rtrim($rowType);
		//	$rowID = rtrim($rowID);

			if ($rowUser == $username && $rowPassword == $password) 
			{
				$_SESSION['username'] = $rowUser;	
				$_SESSION['adminType'] = $rowType;
		//		$_SESSION['adminID'] = $rowID;
				$authorized = true;
				break;
			} 
		//	else
		//	{
		//		echo "<p>Please input correct password</p>";
		//	}
		}
	}

	// Close the connection
	$conn->close();
	unset($rs, $conn);

	if (!$authorized) 
	{
		$_SESSION["message"] = "You are not an employee in the system.";

		header('Location: ../login.php');
		exit();
	} 
	else 
	{
		header('Location: ../index.php');
		exit();
	}
}
catch (Exception $e)
{
	$_SESSION["message"] = "We cannot log you in at this time.";

	header('Location: ../login.php');
	exit();
}

ob_end_clean();
?>
