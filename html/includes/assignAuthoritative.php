<?php
//Connect to database
require 'dbconnection.php';

if (isset($_POST['cfg']) && isset($_POST['switch']) && isset($_POST['sName']))
{
	$cfgID = $_POST['cfg'];
	$switchID = $_POST['switch'];
	$switchName = $_POST['sName'];
}

try
{
	$sql = "SELECT * FROM switchConfigs WHERE switch = $switchID";
	$rs = $conn->query($sql);

	if ($rs->num_rows > 0)
	{
		$sql2 = "UPDATE switchConfigs SET authoritative = 0 WHERE switch = '$switchID' AND authoritative = 1";
		$rs2 = $conn->query($sql2);
	}

	$sql3 = "UPDATE switchConfigs SET authoritative = 1 ";
	$sql3 .= "WHERE configID = $cfgID AND switch = $switchID";

	$rs3 = $conn->query($sql3);

	$_SESSION['message'] = "$switchName updated successfully.";
}
catch (Exception $e)
{
	$_SESSION['message'] = "An error has occurred.";
	
	// Close the connection
	$conn->close();
	unset($rs, $rs2, $rs3, $conn);

	header('Location: ../viewConfigs.php');
	exit();
}

$conn->close();

header('Location: ../viewConfigs.php');

ob_end_flush();
?>
