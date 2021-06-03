<?php
ob_start();
session_start();

// Test the POST data for valid data
if (isset($_POST['assignedAdmins']) && isset($_POST['siteID']))
{
	$assignedAdmins = $_POST['assignedAdmins'];
	$siteID = $_POST['siteID'];
}
else
{
	$_SESSION['message'] = "Error: Cannot assign admins!";
	header('Location: ../assignAdmins.php');
	exit();	
}

// Connect to database
require 'dbconnection.php';

// Try the following
try
{
	// Loop through array and update table
	if (isset($assignedAdmins))
	{
		// Assign variable for loop
		$count = count($assignedAdmins);

		for ($i=0; $i<$count; $i++)
		{
			if ($assignedAdmins[$i] != 0)
			{
				$adminID = $assignedAdmins[$i];
				
				$sql = "INSERT INTO tasks (siteAgent, siteAdmin) VALUES ('$siteID', '$adminID')";
				$rs = $conn->query($sql);
			}
		}
	}
}
catch (Exception $e)
{
	$_SESSION['message'] = "An error has occurred.";

	// Close the connection
	$conn->close();
	unset($rs, $conn);
			
	header('Location: ../assignAdmins.php');
	exit();
}

// Email employees about assigned PMs
if (isset($assignedAdmins))
{
	//require $_SERVER['DOCUMENT_ROOT'].'/pm/includes/email/emailEmployee.php';

	// Redirect to index on success
	$_SESSION['message'] = "Admins assigned.";

	// Close the connection
	$conn->close();
	unset($rs, $conn);

	header('Location: ../assignAdmins.php');
	exit();
}
else 
{
	$_SESSION['message'] = "Nothing was updated.";

	// Close the connection
	$conn->close();
	unset($rs, $conn);

	header('Location: ../assignAdmins.php');
	exit();
}

ob_end_flush();
?>
