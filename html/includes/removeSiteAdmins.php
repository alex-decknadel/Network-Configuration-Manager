<?php
        require 'dbconnection.php';

        if (isset($_POST['siteAdmin']) && isset($_POST['siteAgent']))
        {
		$adminID = $_POST['siteAdmin'];
		$agentID = $_POST['siteAgent'];
        }
        else
        {       header('Location: ../sites.php');
                exit();
        }



        // Delete assign site  from database
        $sql = "DELETE FROM tasks WHERE siteAdmin = $adminID AND siteAgent = $agentID";
        $rs = $conn->query($sql);

        // Close connection
        $conn->close();
        unset($rs, $conn);

        // Go back to previous page
        header('Location: ../sites.php');
        exit();
?>
