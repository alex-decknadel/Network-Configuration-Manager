<?php
// connection values
$serverName = "localhost";
$dbUser = "website";
$dbPassword = "Team4";
$db = "netcon";

// Create connetcion
$conn = new mysqli($serverName, $dbUser, $dbPassword, $db);

// kill connection upon failure
if ($conn->connect_error) 
{
	die("Connection failed: " . $conn->connect_error);
}
?>
