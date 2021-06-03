<?php
	// Test input to determine sql query
	if (isset($_POST['chooseSwitch']) && isset($_POST['chooseConf']))
	{
		$switch = $_POST['chooseSwitch'];
		$conf = $_POST['chooseConf'];
		
		$sql = "SELECT switches.switchID, switches.switchName, ";
		$sql .= "switchConfigs.configID, switchConfigs.filename, ";
		$sql .= "siteAgents.siteName FROM switches INNER JOIN switchConfigs ";
		$sql .= "ON switches.switchID = switchConfigs.switch ";
		$sql .= "INNER JOIN siteAgents ON switches.siteAgent = siteAgents.agentID ";
		$sql .= "WHERE configID = $conf AND switchID = $switch";
	}
	elseif (isset($_SESSION['cfg']))
	{
		$conf = $_SESSION['cfg'];

		$sql = "SELECT switches.switchName, switchConfigs.configID, ";
		$sql .= "switchConfigs.filename, siteAgents.siteName ";
		$sql .= "FROM switches INNER JOIN switchConfigs ";
		$sql .= "ON switches.switchID = switchConfigs.switch ";
		$sql .= "INNER JOIN siteAgents ";
		$sql .= "ON switches.siteAgent = siteAgents.agentID ";
		$sql .= "WHERE configID = $conf";
	}

	// Execute query
	$rs = $conn->query($sql);

	// If match, grab data from query
	if ($rs->num_rows > 0)
	{
		$row = $rs->fetch_assoc();
		
		$switchName = $row['switchName'];
		$switchName = rtrim($switchName);

		$siteName = $row['siteName'];
		$siteName = rtrim($siteName);

		$filename = $row['filename'];
		$filename = rtrim($filename);

		// Create filepath to read
		$path1 = "$siteName/$switchName/$filename";

		// Save current location and change location
		$old_path = getcwd();
		chdir('/home/ubuntu/project/Switch/');

		// Clear variables for reuse
		unset($rs, $row, $sql);

		// Check if authoritative config is needed
		if (isset($_POST['chooseSwitch']) && isset($_POST['chooseConf']))
		{
			$sql = "SELECT switches.switchID, switchConfigs.configID, ";
			$sql .= "switchConfigs.filename FROM switches ";
			$sql .= "INNER JOIN switchConfigs ";
			$sql .= "ON switches.switchID = switchConfigs.switch ";
			$sql .= "WHERE authoritative = 1 AND switchID = $switch";

			$rs = $conn->query($sql);

			$row = $rs->fetch_assoc();

			$filename = $row['filename'];
			$filename = rtrim($filename);

			$authPath = "$siteName/$switchName/$filename";

			$output = shell_exec("diff -c50 $path1 $authPath");

			if (strlen($output) == 0)
			{
				$output = "There is no difference between the two configurations.";
			}
		}
		else
		{
			$output = shell_exec("cat $path1");

			if (strlen($output) == 0)
			{
				$output = "No file here to read.";
			}
		}
	}
	else
	{
		$_SESSION['message'] = "The configuration file does not belong ";
		$_SESSION['message'] .= "to that switch!";
	}

	// Close the connection
	$conn->close();
	unset($rs, $conn);
?>