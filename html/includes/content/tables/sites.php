<?php
// Connect to database
require 'includes/dbconnection.php';

// Set variable to test against
$a = 0;

// Start creating dropdown menu for sites
echo "<div><p class='tmidcol'><select id='siteID' name='siteID'>";

// Create and execute query to look into relevant table
$sql = "SELECT * FROM siteAgents ORDER BY siteName";

$rs = $conn->query($sql);

// Loop through results and display on webpage
if ($rs->num_rows > 0)
{
	while($row = $rs->fetch_assoc()) 
	{	
		$siteID = $row['agentID'];
		$siteID = rtrim($siteID);

		$siteName = $row['siteName'];
		$siteName = rtrim($siteName);

		echo "<option value='$siteID'>$siteName</option>";

		$a++;
	}
}

// Finish making dropdown menu for sites
echo "</select></p>";
unset($sql, $rs);

// Display this message if nothing is displayed or else display site admins
if ($a == 0)
{
	echo "<div><p class='noReturn'>No sites listed.</p></div>";
}
else
{
	// Start making checkboxes for admins
	echo "<div class='checkboxes'>";

	// Create query to look in admins
	$sql2 = 'SELECT adminID, username FROM admins';

	// Execute query
	$rs2 = $conn->query($sql2);
	
	// Set variable for use in checkboxes
	$b = 0;

	// Loop through rows to display in dropdown
	while ($row = $rs2->fetch_assoc())
	{
		// Grab EmpKey, FirstName, and LastName
		$value = $row['adminID'];
		$name = rtrim($row['username']);

		// Echo HTML for checkboxes
		echo "<p>Select to Assign: ";
		echo "<label for='assignedAdmins[$b]'>$name</label>";
		echo "<input type='checkbox' name='assignedAdmins[$b]' ";
		echo "value='$value'/></p>";

		// Increment $b
		$b++;
	}

	echo "</div></div>";
}

// Close the connection
$conn->close();
unset($rs, $conn);
?>