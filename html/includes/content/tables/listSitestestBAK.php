<?php
// Connect to database
require 'includes/dbconnection.php';

// Create and execute query to look into relevant tables
$sql = "SELECT * FROM siteAgents";
$rs = $conn->query($sql);

// Loop through results and display on webpage
if ($rs->num_rows > 0)
{
        while($row = $rs->fetch_assoc())
        {
                $siteID = $row['agentID'];

                $siteName = $row['siteName'];
                $siteName = rtrim($siteName);

                // List current site
                echo "<div class='site'><p>$siteName</p></div>";

                // Create query to look through assigned admins for current site
                $sql2 = "SELECT tasks.siteAgent, admins.username, tasks.siteAdmin FROM tasks ";
                $sql2 .= "INNER JOIN admins ON tasks.siteAdmin = admins.adminID ";
                $sql2 .= "WHERE siteAgent = $siteID";

                $rs2 = $conn->query($sql2);

                if ($rs2->num_rows > 0)
                {
                        // Loop through site admins for site
                        while ($row2 = $rs2->fetch_assoc())
                        {
                                $adminName = $row2['username'];
				$adminName = rtrim($adminName);

				$adminID = $row2['siteAdmin'];
				$adminID = rtrim($adminID);

				$agentID = $row2['siteAgent'];
				$agentID = rtrim($agentID);

				echo "<div class='listAdmin'><p class='tmidcol'>$adminName</p>";
				echo "<form action='includes/removeSiteAdmins.php' ";
                                echo "class='deleteForm' method='post'>";
				echo "<input type='hidden' name='siteAdmin' value='$adminID' />";
				echo "<input type='hidden' name='siteAgent' value='$agentID' />";
                                echo "<input type='submit' value='Remove' />";
                                echo "</form>";
				echo "</div>";
                        }
                }
                else
                {
                        echo "<div class='listAdmin'><p class='tlastcol'>There are no site admins for this site.</p></div>";
                }
        }
}
else
{
        // Display this message if nothing is displayed
        echo "<div><p class='noReturn'>No sites listed.</p></div>";
}

// Close the connection
$conn->close();
unset($rs, $conn);
?>
