<?php
	session_start();

	$time = date('h:i A');

	echo $time;

	$_SESSION['timedateRefreshCount'] = $_SESSION['timedateRefreshCount'] + 1;
?>