<?php
session_start();

// Set variables
$dupe = false;
$previousPage = $_POST['page'];

// Try the following
try 
{
	// If required fields are POSTed, set variables
	if (isset($_POST['siteName'])) 
	{
		$first = $_POST['siteName'];
		$table = 'siteAgents';
	}
	elseif (isset($_POST['adminName']) && isset($_POST['password']) 
		&& isset($_POST['email']))
	{
		$first = $_POST['adminName'];
		$third = $_POST['password'];
		$second = $_POST['email'];
		$table = 'admins';
	}
	elseif (isset($_POST['switchName']) && isset($_POST['site']) 
		&& isset($_POST['connectionMode']) && isset($_POST['ipAddress']))
	{
		$first = $_POST['switchName'];
		$second = $_POST['ipAddress'];
		$third = $_POST['connectionMode'];

		if (isset($_POST['authentication']))
		{
			$fourth = $_POST['authentication'];
		}

		$fifth = $_POST['site'];
		$table = 'switches';
	}
	elseif (isset($_POST['labelName']) && isset($_POST['cfg']))
	{
		$first = $_POST['labelName'];
		$second = $_POST['cfg'];
		$table = 'labels';
	}

	// Connect to database
	require 'dbconnection.php';

	// Create and execute query to look in Emp
	$sql = "SELECT * FROM $table";
	$rs = $conn->query($sql);

	// Look through results and check for matching entries
	switch ($table)
	{
		case 'sitesAgents':
			// Look through results and check for matching entries
			while ($row = $rs->fetch_assoc()) 
			{	
				$rowID = $row['agentID'];
				$rowID = rtrim($rowID);

				$rowFirst = $row['siteName'];
				$rowFirst = rtrim($rowFirst);

				// If submission is dupe, set $dupe to true
				if ($rowFirst == $first) 
				{
					$dupe = true;
					$_SESSION['message'] = 'This site is already in the system.';
					break;
				}
			}

			break;
		case 'admins':
			// Look through results and check for matching entries
			while ($row = $rs->fetch_assoc()) 
			{	
				$rowID = $row['adminID'];
				$rowID = rtrim($rowID);

				$rowFirst = $row['username'];
				$rowFirst = rtrim($rowFirst);

				$rowSecond = $row['email'];
				$rowSecond = rtrim($rowSecond);

				$rowThird = $row['password'];
				$rowThird = rtrim($rowThird);

				// If submission is dupe, set $dupe to true
				if ($rowFirst == $first && $rowSecond == $second) 
				{
					$dupe = true;
					$_SESSION['message'] = 'This admin is already in the system.';
					break;
				}
			}

			break;
		case 'switches':
			// Look through results and check for matching entries
			while ($row = $rs->fetch_assoc())
			{
				$rowID = $row['switchID'];
				$rowID = rtrim($rowID);

				$rowFirst = $row['switchName'];
				$rowFirst = rtrim($rowFirst);

				$rowSecond = $row['ipAddress'];
				$rowSecond = rtrim($rowSecond);

				$rowThird = $row['connectionMode'];
				$rowThird = rtrim($rowThird);

				$rowFourth = $row['authenticationString'];
				$rowFourth = rtrim($rowFourth);

				$rowFifth = $row['siteAgent'];
				$rowFifth = rtrim($rowFifth);

				// If submission is dupe, set $dupe to true
				if ($rowFirst == $first && $rowFifth == $fifth)
				{
					$dupe = true;
					$_SESSION['message'] = 'This switch is already in the ';
					$_SESSION['message'] .= 'system.';
					break;
				}
				elseif ($rowSecond == $second && $rowFifth == $fifth)
				{
					$dupe = true;
					$_SESSION['message'] = 'A switch already has this IP ';
					$_SESSION['message'] .= 'address on the selected site.';
					break;				
				}
			}

			break;
		case 'labels':
			// Look through results and check for matching entries
			while($row = $rs->fetch_assoc())
			{
				$rowID = $row['labelID'];
				$rowID = rtrim($rowID);

				$rowFirst = $row['labelName'];
				$rowFirst = rtrim($rowFirst);

				$rowSecond = $row['switchConfig'];
				$rowSecond = rtrim($rowSecond);

				// If submission is dupe, set $dupe to true
				if ($rowFirst == $first && $rowSecond == $second)
				{
					$dupe = true;
					$_SESSION['message'] = 'This label is already in the system.';
					break;
				}
			}

			break;
	}
	
	// Close the connection
	$rs->close();
	$conn->close();
	unset($rs, $conn);

	// Set session variables for input
	$_SESSION['input1'] = $first;

	if (isset($second))
	{
		$_SESSION['input2'] = $second;
	}

	if (isset($third))
	{
		$_SESSION['input3'] = $third;
	}

	if (isset($fourth))
	{
		$_SESSION['input4'] =  $fourth;
	}

	if (isset($fifth))
	{
		$_SESSION['input5'] = $fifth;
	}

	// Redirect to appropriate page based off the value of $dupe
	if (!$dupe) 
	{
		$_SESSION['table'] = $table;
		$_SESSION['page'] = $previousPage;

		header('Location: confirmed.php');
		exit();
	} 
	else 
	{
		header('Location: '.$previousPage); 
		exit();
	}
}
catch (Exception $e)
{
	$_SESSION['message'] = 'An error has occurred during submission.';

	$conn->close();
	unset($rs, $conn);

	header('Location: '.$previousPage);
	exit();
}
?>
