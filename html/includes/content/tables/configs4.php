<?php
// Connect to database
require 'includes/dbconnection.php';

if (!isset($_POST['chooseSite']))
{
	echo "<div><p class='noReturn'>Select a Site</p></div>";
}
else
{
	// set variables for later use
	$currUser = $_SESSION['username'];
	$chosenSite = $_POST['chooseSite'];
	$count = 0;

	// Grab name of site
	$sqlName = "select siteName from siteAgents where agentID = $chosenSite";
	$namers = $conn->query($sqlName);
	$nameRow = $namers->fetch_assoc();
	$siteName = $nameRow['siteName'];

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
		// Grab siteID for queries on switches table
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
				
				// Query for switch Configs
				$sql3 = "SELECT * FROM switchConfigs WHERE switch = $switchID "; 
				$sql3 .= "ORDER BY filename";

				$rs3 = $conn->query($sql3);
				$rowCount = ($rs3->num_rows);
				$rowCounter = 0;
				
				// Write rows into HTML table
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

					$compare = "";
					$authCompare = "";

					while ($row2 = $rs3->fetch_assoc())
					{
						// Increment rowCounter
						++$rowCounter;

						// Grab data from query and trim whitespace
						$cfgID = $row2['configID'];
					
						$cfgTime = $row2['logTime'];
						$cfgTime = rtrim($cfgTime);

						$cfgFile = $row2['filename'];
						$cfgFile = rtrim($cfgFile);
												
						$cfgAuth = $row2['authoritative'];

						//Compare current config to older config
						if (isset($cfgOld))
						{
							// Save current path and set new path
							$old_path = getcwd();
							$cfgpath = "/home/ubuntu/project/Switch/";
							$cfgpath .= "$siteName/$switchName/";

							// Change file path and run diff
							chdir("$cfgpath");
							$compare = shell_exec("diff -q $cfgFile $cfgOld");
							chdir("$old_path");
						}

						// Start table row
						echo "<div class='configs'>";

						// Add label to table
						$sql4 = "SELECT * FROM labels WHERE switchConfig = $cfgID";

						$rs4 = $conn->query($sql4);

						if ($rs4->num_rows > 0)
						{
							while ($row3 = $rs4->fetch_assoc())
							{
								$labelName = $row3['labelName'];
								$labelName = rtrim($labelName);

								echo "<p class='tfirstcol'>$labelName</p>";
							}
						}
						else
						{
							echo "<p class='tfirstcol'></p>";
						}

						// Check if we are on something other than the last row
						if ($rowCounter < $rowCount)
						{	
							// If there is a difference, state that there's a difference.
							if (strlen($compare) == 0) 
							{	
								echo "<p class='confDT'>$cfgTime</p>";					
							}
							else
							{
								echo "<p class='confDT'>$cfgTime differs</p>";
							}
						}
						// If last config is authoritative or there is no authoritative config
						elseif (($cfgAuth == 1) || (!(isset($authCfgFile))))
						{
							// If a difference exists, state that it does
							if (strlen($compare) == 0) 
							{							
								echo "<p class='confDT'>$cfgTime</p>";		
							}
							else
							{
								echo "<p class='confDT'>$cfgTime differs</p>";
							}	
						}
														
						// Compare current file to auth file
						// Display a RED WARNING if there is a difference
						else
						{
							
							// Save current path and set new path
							$old_path = getcwd();
							$cfgpath = "/home/ubuntu/project/Switch/";
							$cfgpath .= "$siteName/$switchName/";

							// Change location and run diff
							chdir("$cfgpath");
							$authCompare = shell_exec("diff -q $cfgFile $authCfgFile");
							chdir("$old_path");
			
							// Compare files
							if (strlen($authCompare) == 0)
							{	
								if (strlen($compare) == 0) 
								{				
									echo "<p class='confDT'>$cfgTime</p>";					
								}
								else
								{
									echo "<p class='confDT'>$cfgTime differs</p>";
								}
							}
							// Final config doesn't match authoritative config
							else					
							{
								// Check $compare to see if it has a value
								if (strlen($compare) == 0) 
								{
									echo "<p class='confDT'><span style='color:red'>";
									echo "DIFFERS FROM AUTH</span>";
									echo "$cfgTime</p>";
								}
								else
								{
									echo "<p class='confDT'><span style='color:red'>";
									echo "Differs from auth and previous</span>";
									echo "$cfgTime</p>";
								}			 
							}	
						}	

						// Check to see if current file is authoritative
						if ($cfgAuth == 0)
						{			
							echo "<p class='authCol'><label for='chosen'>Select to Set:</label>";
							echo "<input type='radio' name='chosen$count' ";
							echo "value='$cfgID' /></p></div>";
						}
						else
						{
							$authCfgFile = $cfgFile;
							echo "<p class='authCol'><label for='chosen'>Select to Set:</label>";
							echo "<input type='radio' name='chosen$count' ";
							echo "value='$cfgID' checked /></p></div>";
						}
						
						$cfgOld = $cfgFile;
					}

					// Unset variables for next switch
					unset ($cfgOld);
					unset ($rowCounter);
					unset ($rowCount);
					unset ($authCfgFile);
					unset ($authCompare);

					echo "<div><p class='noReturn'><input type='submit' ";
					echo "value='Update Authoritative'/></p></div></form>";
					echo "<script>$('input[name=\"chosen$count\"]').click(function() {";
					echo "$('#cfg$count').val(this.value);});</script>";

					// Write display file buttons for each configuration file
					$rs3 = $conn->query($sql3);

					if ($rs3->num_rows > 0)
					{
						 echo "<div class='actionForms'>";
						
						while ($row2 = $rs3->fetch_assoc())
						{
							$cfgID = $row2['configID'];
							$cfgFile = $row2['filename'];
							$authValue = $row2['authoritative'];

							echo "<form action='includes/actions.php' ";
							echo "class='actionForm' method='post'>";
							echo "<input type='hidden' name='cfg' ";
							echo "value='$cfgID'>";
							echo "<input type='hidden' name='page' value='";
							echo htmlentities($_SERVER['PHP_SELF']);
							echo "' />";
							echo "<input type='hidden' name='authValue' value='$authValue' />";
							echo "<input type='hidden' name='siteName' value='$siteName' />";
							echo "<input type='hidden' name='switchName' value='$switchName' />";
							echo "<input type='hidden' name='configName' value='$cfgFile' />";
							echo "<input type='submit' name='action' value='Read' />";
							echo "<input type='submit' name='action' value='Delete' onclick='return confirm(\"Are you sure you want to delete this config?\")'/>";
						    echo "<input type='submit' name='action' value='Set Label' /></form>";
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
