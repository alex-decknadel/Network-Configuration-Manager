<?php
	// Connect to database
	require 'includes/dbconnection.php';

	$currUser = $_SESSION['username'];

	// Grab ID of current user
	$sql = "SELECT * FROM admins WHERE username = '$currUser'";

	$rs = $conn->query($sql);

	$row = $rs->fetch_assoc();

	$currID = $row['adminID'];

	// Create and execute a query
	$sql = "SELECT siteAgents.siteName, switches.switchID, ";
	$sql .= "switches.switchName, switches.ipAddress, ";
	$sql .= "switches.connectionMode, switches.authenticationString, ";
	$sql .= "siteAgents.siteName, tasks.siteAdmin FROM siteAgents ";
	$sql .= "INNER JOIN switches ON siteAgents.agentID = switches.siteAgent ";
	$sql .= "INNER JOIN tasks ON siteAgents.agentID = tasks.siteAgent ";
	$sql .= "WHERE siteAdmin = $currID ORDER BY siteName, switchID";

	$rs = $conn->query($sql);

	// Loop through rows in table
	if ($rs->num_rows > 0)
	{
		while ($row = $rs->fetch_assoc())
		{	
			// Get data and trim whitespace
			$switchID = $row['switchID'];

			$switchName = $row['switchName'];
			$switchName = rtrim($switchName);

			$ipAddress = $row['ipAddress'];
			$ipAddress = rtrim($ipAddress);

			$connMode = $row['connectionMode'];
			$connMode = rtrim($connMode);			

			$siteName = $row['siteName'];
			$siteName = rtrim($siteName);

			// Write rows into HTML table
			echo "<div><p class='tfirstcol'>$switchName</p>";
			echo "<p class='tmidcol'>$siteName</p>";
			echo "<p class='tlastcol'>$ipAddress</p>";
			echo "<p class='tlastcol'>$connMode</p>";
			echo "<form action='includes/actions.php' ";
			echo "class='actionForm' method='post'>";
			echo "<input type='hidden' name='switch' value='$switchID' />";
			echo "<input type='hidden' name='switchName' value='$switchName' />";
			echo "<input type='hidden' name='siteName' value='$siteName' />";
			echo "<input type='hidden' name='page' value='";
			echo htmlentities($_SERVER['PHP_SELF']);
			echo "' />";
			echo "<input type='submit' name='action' value='Edit' />";
			echo "<input type='submit' name='action' value='Delete' />";
			echo "</form></div>";
		}
	}
	else
	{
		// Display this message if nothing is returned
		echo "<div><p class='noReturn'>No switches in here.</p></div>";
	}

	// Close the connection
	$conn->close();
	unset($rs, $conn);
?>
