<?php
        include 'includes/dbconnection.php';

        $sql="SELECT * FROM admins WHERE adminType='Site Admin'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
        {
                // output data of each row
                while($row = $result->fetch_assoc())
                {
                        $user = $row['username'];
                        $user = rtrim($user);

                        $email = $row['email'];
                        $email = rtrim($email);

                        $password = $row['password'];
                        $password = rtrim($password);

                        $adminID = $row['adminID'];
                        $adminID =rtrim($adminID);

                        echo "<div class='siteAdmin'><p class='tfirstcol'>$user</p>";
                        echo "<p class='tmidcol'>$email</p>";
                        echo "<p class='tlastcol'></p>";
                        echo "<form action='includes/deletesiteAdmins.php' ";
                        echo "class='actionForm' method='post' onsubmit='return confirm(\"Are you sure you want to delete this admin?\")'>";
                        echo "<input type='hidden' name='adminID' value='$adminID' />";
                        echo "<input type='submit' value='Delete' />";
                        echo "</form>";
                        echo "</div>";

                        // Create query to look through assigned admins for current site
                        $sql2 = "SELECT tasks.siteAdmin, siteAgents.siteName ";
                        $sql2 .= "FROM tasks INNER JOIN siteAgents ";
                        $sql2 .= "ON tasks.siteAgent = siteAgents.agentID ";
                        $sql2 .= "WHERE siteAdmin = $adminID";

                        $rs2 = $conn->query($sql2);

                        if ($rs2->num_rows > 0)
                        {
                                while ($row2 = $rs2->fetch_assoc())
                                {
                                        $siteName = $row2['siteName'];
                                        $siteName = rtrim($siteName);

                                        echo "<div class='listSite'>";
                                        echo "<p class='tfirstcol'></p>";
                                        echo "<p class='tmidcol'></p>";
                                        echo "<p class='tlastcol'>$siteName</p>";
                                        echo "<p class='tlastcol'></p></div>";
                                }
                        }
                }
        }
        else
        {
                echo "<div class='noReturn'><p>There are no site admins listed.";
                echo "</p></div>";
        }

        $conn->close();
?>
