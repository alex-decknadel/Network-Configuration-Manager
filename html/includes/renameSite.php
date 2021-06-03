<?php
        require 'dbconnection.php';

        // Check to see if there's valid input
        if (isset($_POST['oldSiteName']) && isset($_POST['newSiteName']) 
                && isset($_POST['siteID']))
        {
		$oldSiteName = $_POST['oldSiteName'];
		$newSiteName = $_POST['newSiteName'];
		$siteID = $_POST['siteID'];
        }
	else
        {       header('Location: ../sites.php');
                exit();
        }

        // Rename site in database
        $sql = "UPDATE siteAgents SET siteName='$newSiteName' ";
        $sql .= "WHERE agentID = $siteID AND siteName='$oldSiteName'";
        $rs = $conn->query($sql);

        // Close connection
        $conn->close();
        unset($rs, $conn);

        // Change current path
        $oldPath = getcwd();
        $newPath = "/home/ubuntu/project/Switch";
        chdir("$newPath");
		
	// Rename the folder that shares the old siteName
	shell_exec("mv $oldSiteName $newSiteName");

        // Return to previous path
        chdir("$oldPath");

        // Go back to previous page
        header('Location: ../sites.php');
        exit();
?>