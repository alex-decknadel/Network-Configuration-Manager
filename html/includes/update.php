<?php
	session_start();

	require 'dbconnection.php';

	if (isset($_POST['page']))
	{
		$previousPage = $_POST['page'];
	}

	if (isset($_POST['switchName']) && isset($_POST['site']) 
		&& isset($_POST['ipAddress']) && isset($_POST['connectionMode']) 
		&& isset($_POST['switch']) && isset($_POST['oldSwitchName'])
		&& isset($_POST['oldSiteName']))
	{
		try
		{
			$switchName = $_POST['switchName'];
			$site = $_POST['site'];
			$ipAddress = $_POST['ipAddress'];
			$connMode = $_POST['connectionMode'];
			$switch = $_POST['switch'];
			$oldSwitchName = $_POST['oldSwitchName'];
			$oldSiteName = $_POST['oldSiteName'];

			if (isset($_POST['authentication']))
			{
				$authString = $_POST['authentication'];
			}

			$sql = "SELECT * FROM switches WHERE switchID = $switch";
			$rs = $conn->query($sql);

			if ($rs->num_rows == 1)
			{
				$row = $rs->fetch_assoc();

				$oldIP = $row['ipAddress'];
				$oldConn = $row['connectionMode'];
				$oldAuth = $row['authenticationString'];
			}

			unset($rs, $sql);

			$sql = "SELECT siteName FROM siteAgents WHERE agentID = $site";
			$rs = $conn->query($sql);

			if ($rs->num_rows == 1)
			{
				$row = $rs->fetch_assoc();
				$siteName = $row['siteName'];
			}

			unset($rs, $sql);

			if ($switchName != $oldSwitchName || $oldSiteName != $siteName 
				|| $ipAddress != $oldIP || $connMode != $oldConn 
				|| $authString != $oldAuth)

			$sql = "UPDATE switches ";
			$sql .= "SET switchName = '$switchName', ipAddress = '$ipAddress', ";
			$sql .= "connectionMode = '$connMode', siteAgent = $site";
			
			if (isset($authString))
			{	
				$sql .= ", authenticationString = '$authString'";
			}

			$sql .= " WHERE switchID = $switch";

			$rs = $conn->query($sql);

			$conn->close();
			unset($rs, $sql, $conn);

			$old_path = getcwd();

			chdir('/home/ubuntu/project/Switch/');

			$path = "$oldSiteName/$oldSwitchName";
			$rename = "$siteName/$switchName";

			if (file_exists($path) && $path != $rename)
			{
				shell_exec("mv $path $rename");
			}

			chdir($old_path);
			header('Location: ' . $previousPage);
			exit();
		}
		catch (Exception $e)
		{
			$conn->close();
			unset($rs, $conn);

			$_SESSION['message'] = "Unexpected error.";
			header('Location: ' . $previousPage);
			exit();
		}
	}
	else
	{
		try
		{
			$_SESSION['message'] = "Nothing changed because of missing data.";
			header('Location: ' . $previousPage);
			exit();
		}
		catch (Exception $e)
		{
			$_SESSION['message'] = "Problem redirecting to previous page.";
			header('Location: index.php');
			exit();
		}
	}
?>