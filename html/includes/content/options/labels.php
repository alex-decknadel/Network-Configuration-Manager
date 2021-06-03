<?php
	// Connect to database
	require 'includes/dbconnection.php';

	$chosenConfig = $_POST['config'];
	
	// Create query to look in table
	$sql = "SELECT * FROM label ";
	$sql .= "WHERE switchConfig = $chosenConfig ORDER BY label ASC";
	
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
