<?php
	// Connect to database
	require '../../dbconnection.php';

	if (isset($_POST['get_option']))
	{
		$switch = $_POST['get_option'];
		$sql = "SELECT configID, logTime FROM switchConfigs WHERE switch = $switch AND authoritative != 1";

		// Execute query
		$rs = $conn->query($sql);

		if ($rs == true && $rs->num_rows > 0)
		{
			echo "<option disabled>Select Configuration</option>";

        	// Loop through rows to display in dropdown
        	while ($row = $rs->fetch_assoc())
        	{
				// Grab ETypeKey and ETypeID
                $confID = $row['configID'];
                $confID = rtrim($confID);

                $confTime = $row['logTime'];
        		$confTime = rtrim($confTime);

                // Echo HTML for dropdown menu
                echo '<option value="'.$confID.'">'.$confTime.'</option>';
			}
		}
		else
		{
			echo "<option>Select Configuration</option>";
		}

		// Close the connection
		$conn->close();

	}
?>
