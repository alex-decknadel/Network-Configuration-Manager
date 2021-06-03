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
                // Grab site info
                $siteID = $row['agentID'];

                $siteName = $row['siteName'];
                $siteName = rtrim($siteName);

                // List current site
                echo "<div class='site'><p>$siteName";
                
                // Echo a "rename" form into the "table" row for each site
                echo "<form action='includes/renameSite.php' ";
                echo "class='siteRename' method='post'>";
                echo "<input type='text' name='newSiteName' ";
                echo "placeholder='New name for $siteName' required />";
                echo "<input type='hidden' name='oldSiteName' ";
                echo "value='$siteName' />";
                echo "<input type='hidden' name='siteID' value='$siteID' />";
                echo "<input type='submit' name='Rename' value ='Rename' />";
                echo "</div></form>";

                // Create query to look through assigned admins for current site
                $sql2 = "SELECT tasks.siteAgent, admins.username, ";
                $sql2 .= "tasks.siteAdmin FROM tasks ";
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

                                // Write rows of admins to table
                                echo "<div class='listAdmin'>";
                                echo "<p class='tmidcol'>$adminName</p>";
                                echo "<form action='includes/removeSiteAdmins.php' ";
                                echo "class='actionForm' method='post' onsubmit='return confirm(\"Are you sure you want to unassign $adminName from $siteName?\")'>";
                                echo "<input type='hidden' name='siteAdmin' ";
                                echo "value='$adminID' />";
                                echo "<input type='hidden' name='siteAgent' ";
                                echo "value='$agentID' />";
                                echo "<input type='submit' value='Remove' />";
                                echo "</form></div>";
                        }
                }
                else
                {
                        echo "<div class='listAdmin'><p class='tlastcol'>";
                        echo "There are no site admins for this site.</p></div>";
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