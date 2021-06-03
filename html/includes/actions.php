<?php
	session_start();

	// Test to see if needed input exists
	if (isset($_POST['action']) && isset($_POST['page']))
	{
		$previousPage = $_POST['page'];

		if (isset($_POST['switch']) && isset($_POST['switchName']) 
			&& isset($_POST['siteName']))
		{
			$switch = $_POST['switch'];
			$switchName = $_POST['switchName'];
			$siteName = $_POST['siteName'];
		}
		elseif (isset($_POST['configName']) && isset($_POST['switchName']) 
			&& isset($_POST['cfg']) && isset($_POST['siteName'])
			&& isset($_POST['authValue']))
		{
			
			$authValue = $_POST['authValue'];
			$siteName = $_POST['siteName'];
			$configName = $_POST['configName'];
			$switchName = $_POST['switchName'];
			$cfg = $_POST['cfg'];
		}
		else
		{
			$_SESSION['message'] = "An error has occurred. Please try again.";
			header('Location: '.$previousPage);
			exit();
		}

		switch ($_POST['action'])
		{
			case 'Delete':
				// Check to see if config is authoritative
				if ($authValue == 1)
				{
					$_SESSION['message'] = "Configuration is authoritative. ";
					$_SESSION['message'] .= "Cannot delete.";
					header('Location: '.$previousPage);
					exit();
				}
				else
				{
					include 'delete.php';

					// Redirect to previous page
					header('Location: ' . $previousPage);
					break;
				}
			case 'Edit':
				$_SESSION['page'] = $previousPage;
				$_SESSION['switch'] = $switch;
				$_SESSION['switchName'] = $switchName;
				$_SESSION['siteName'] = $siteName;

				// Redirect to next page
				header('Location: ../editSwitch.php');
				break;
			case 'Read':
				$_SESSION['cfg'] = $cfg;
				
				// Redirect to next page
				header('Location: ../displayConfig.php');
				break;
			case 'Set Label':
				$_SESSION['cfg'] = $cfg;

				//  Redirect to next page
				header('Location: ../labels.php');
				break;
			default:
				$_SESSION['message'] = "Nothing happened.";
				
				// Redirect to previous page
				header('Location: ' . $previousPage);
		}
		
		exit();
	}
	else
	{
		$_SESSION['message'] = "An error has occurred. Please try again.";
		header('Location: index.php');
		exit();
	}
?>
