<?php
	session_start();

	require 'dbconnection.php';

	//if (isset($_POST['page']))
//	{
		//$previousPage = $_POST['page'];
//	}

	if (isset($_POST['chooseConf']) && isset($_POST['lable'])) 
	{
		try
		{
			$cfgID = $_POST['chooseConf'];
			$cfgLable = $_POST['lable'];

			$sql = "SELECT * FROM switchConfigs WHERE configID = $cfgID";
			$rs = $conn->query($sql);

			if ($rs->num_rows == 1)
			{
				$row = $rs->fetch_assoc();

				$oldLable = $row['Nickname'];
			}

			unset($rs, $sql);


			if ($cfgLable != $oldLable)

			$sql = "UPDATE switchConfigs ";
			$sql .= "SET Nickname = '$cfgLable' ";
			$sql .= "WHERE configID = $cfgID";

			$rs = $conn->query($sql);

			$conn->close();
			unset($rs, $sql, $conn);

			header('Location: ../displayConfig.php');
			exit();
		}
		catch (Exception $e)
		{
			$conn->close();
			unset($rs, $conn);

			$_SESSION['message'] = "Unexpected error.";
			header('Location: ../displayConfig.php');
			exit();
		}
	}
	else
	{
		try
		{
			$_SESSION['message'] = "Nothing changed because of missing data.";
			header('Location: ../displayConfig.php');
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
