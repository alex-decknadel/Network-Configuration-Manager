<?php
        require 'dbconnection.php';

        if (isset($_POST['adminID']))
        {
                $adminID = $_POST['adminID'];
        }
        else
        {	header('Location: ../siteAdmins.php');
                exit();
        }



        // Delete tasks from database
        $sql = "DELETE FROM tasks WHERE siteAdmin = $adminID";
        $rs = $conn->query($sql);

        // Delete admin from database
        $sql = "DELETE FROM admins WHERE adminID = $adminID";
        $rs = $conn->query($sql);

        // Close connection
        $conn->close();
        unset($rs, $conn);

        // Go back to previous page
        header('Location: ../siteAdmins.php');
        exit();
?>
