<?php
	// Write first option
	echo '<option value="0">Don\'t assign yet</option>';
	
	// Create query to look in admins
	$sql2 = 'SELECT adminID, username FROM admins';

	// Execute query
	$rs2 = $conn->query($sql2);

	// Loop through rows to display in dropdown
	while ($row = $rs2->fetch_assoc())
	{
		// Grab EmpKey, FirstName, and LastName
		$value = $row['adminID'];
		$name = rtrim($row['username']);

		// Echo HTML for dropdown menu
		echo '<option value="'.$value.'">'.$name.'</option>';
	}
?>
