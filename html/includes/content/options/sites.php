<?php
	// Connect to database
	require 'includes/dbconnection.php';

	$currUser = $_SESSION['username'];

	// Grab ID of current user
	$sql = "SELECT * FROM admins WHERE username = '$currUser'";

	$rs = $conn->query($sql);

	$row = $rs->fetch_assoc();

	$currID = $row['adminID'];

	// Create query to look in table
	$sql = "SELECT siteAgents.agentID, siteAgents.siteName, tasks.siteAdmin FROM siteAgents ";
	$sql .= "INNER JOIN tasks ON siteAgents.agentID = tasks.siteAgent WHERE tasks.siteAdmin = '$currID' ";
	$sql .= "ORDER BY agentID ASC";

	// Execute query
	$rs = $conn->query($sql);

	// Loop through rows to display in dropdown
	while ($row = $rs->fetch_assoc())
	{
		// Grab ETypeKey and ETypeID
		$siteID = $row['agentID'];
		$siteID = rtrim($siteID);

		$siteName = $row['siteName'];
		$siteName = rtrim($siteName);

		// Echo HTML for dropdown menu
		if (isset($_POST['chooseSite']))
		{
			if ($siteID == $_POST['chooseSite'])
			{
				echo "<option value='$siteID' selected>$siteName</option>";
			}
			else
			{
				echo "<option value='$siteID'>$siteName</option>";
			}
		}
		else
		{
			echo "<option value='$siteID'>$siteName</option>";
		}	
	}

	// Close the connection
	$conn->close();
?>
