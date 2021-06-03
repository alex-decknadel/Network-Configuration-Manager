<?php
	session_start();

	if (!isset($_SESSION['username']) && !isset($_SESSION['adminType'])) 
	{
		header('Location: login.php');
		exit();
	}

	if (!isset($_SESSION['message']))
	{
		$_SESSION['message'] = "";
	}
?>
