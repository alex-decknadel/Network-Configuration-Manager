<?php
// Connect to database
require 'includes/dbconnection.php';

if (!isset($_POST['chooseSite']))
{
	echo "<div><p class='noReturn'>Select a Site</p></div>";
}
else
{
	$currUser = $_SESSION['username'];
	$chosenSite = $_POST['chooseSite'];
	$count = 0;

	// Grab ID of current user
	$sql = "SELECT * FROM admins WHERE username = '$currUser'";

	$rs = $conn->query($sql);

	$row = $rs->fetch_assoc();

	$currID = $row['adminID'];

	// Create and execute a query
	$sql = "SELECT * FROM tasks WHERE siteAdmin = $currID ";
	$sql .= "AND siteAgent = $chosenSite";

	$rs = $conn->query($sql);

	// Loop through rows in table
	if ($rs->num_rows > 0)
	{

		// grab siteID for queries on switches table
		$sql2 = "SELECT switchID, switchName, siteAgent FROM switches ";
		$sql2 .= "WHERE siteAgent = $chosenSite";
	
		$rs2 = $conn->query($sql2);

		if ($rs2->num_rows > 0)
		{
			while ($row = $rs2->fetch_assoc())
			{
				// Get data and trim whitespace
				$switchID = $row['switchID'];

				$switchName = $row['switchName'];
				$switchName = rtrim($switchName);

				$sql3 = "SELECT * FROM switchConfigs WHERE switch = $switchID ";
				$sql3 .= "ORDER BY filename";

				$rs3 = $conn->query($sql3);

				if ($rs3->num_rows > 0)
				{
					echo "<div class='configForms'>";
					echo "<form action='includes/assignAuthoritative.php' ";
					echo "class='assignAuthoritative' method='post'>";
					echo "<input type='hidden' id='cfg$count' name='cfg' value=''/>";
					echo "<input type='hidden' name='switch' value='$switchID' />";
					echo "<input type='hidden' name='sName' value='$switchName' />";
					echo "<div class='switches'><p class='tfirstcol'>";
					echo "$switchName</p></div>";

					while ($row2 = $rs3->fetch_assoc())
					{
						$cfgID = $row2['configID'];
					
						$cfgTime = $row2['logTime'];
						$cfgTime = rtrim($cfgTime);

						$cfgAuth = $row2['authoritative'];	
				
						// Write rows into HTML table
						echo "<div class='configs'><p>$cfgTime</p>";
			
						if ($cfgAuth == 0)
						{			
							echo "<p><label for='chosen'>Select to Set:</label>";
							echo "<input type='radio' name='chosen$count' ";
							echo "value='$cfgID' /></p></div>";
						}
						else
						{
							echo "<p><label for='chosen'>Select to Set:</label>";
							echo "<input type='radio' name='chosen$count' ";
							echo "value='$cfgID' checked /></p></div>";
						}
					}

					echo "<div><p class='noReturn'><input type='submit' ";
					echo "value='Update Authoritative'/></p></div></form>";
					echo "<script>$('input[name=\"chosen$count\"]').click(function() {";
					echo "$('#cfg$count').val(this.value);});</script>";

					// Write display file buttons for each configuration file
					$rs3 = $conn->query($sql3);

					if ($rs3->num_rows > 0)
					{
						 echo "<div class='readForms'>";
						
						while ($row2 = $rs3->fetch_assoc())
						{
							$cfgID = $row2['configID'];
							echo "<form action='displayConfig.php' ";
							echo "class='readForm' method='post'>";
							echo "<input type='hidden' name='readCfg' ";
							echo "value='$cfgID'>";
							echo"<input type='submit' name='action' value='Read'></form>";
						}

						echo "</div>";
					}
					
					echo "</div>";

					$count++;
				}
			}
		}
		else
		{
			// Display this message if nothing is returned
			echo "<div><p class='noReturn'>No switches in this site.</p></div>";
		}
	}
	else
	{
		// Display this message if nothing is returned
		echo "<div><p class='noReturn'>No configurations here.</p></div>";
	}

	// Close the connection
	$conn->close();
	unset($rs, $conn, $rs2);
}
?>