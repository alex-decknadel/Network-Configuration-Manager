<?php
	// Connect to database
	require 'includes/dbconnection.php';

	$chosenSite = $_POST['chooseSite'];
	
	// Create query to look in table
	$sql = "SELECT switchID, switchName, siteAgent FROM switches ";
	$sql .= "WHERE siteAgent = '$chosenSite' ORDER BY switchID ASC";
	
	// Execute query
	$rs = $conn->query($sql);

	// Loop through rows to display in dropdown
	while ($row = $rs->fetch_assoc())
	{
		// Grab ETypeKey and ETypeID
		$switchID = $row['switchID'];
		$switchID = rtrim($switchID);

		$switchName = $row['switchName'];
		$switchName = rtrim($switchName);

		// Echo HTML for dropdown menu
		echo '<option value="'.$switchID.'">'.$switchName.'</option>';
	}

	// Close the connection
	$conn->close();
?>
