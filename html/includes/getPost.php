<?php
	// Test input to determine sql query
	if (isset($_POST['chooseSwitch']) && isset($_POST['chooseConf']))
	{
		$switch = $_POST['chooseSwitch'];
		$conf = $_POST['chooseConf'];
	}
	elseif (isset($_SESSION['cfg']))
	{
		$conf = $_SESSION['cfg'];

	}

?>
