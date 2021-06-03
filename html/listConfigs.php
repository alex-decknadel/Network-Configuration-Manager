<?php include 'includes/session_start.php'; ?>

<!DOCTYPE html>

<html lang="en">

<?php
        include "includes/head.php";
        include "includes/head2.php";
?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


</head>
<body>

<?php include "includes/content/header.php"?>

      <main class="innerwrap">

          <article>

               <section>

                    <h1>Previous Configurations</h1>

                     <div style="margin: 2em 1em;">

<?php
        require 'includes/dbconnection.php';

        if (isset($_POST['chooseSwitch']))
        {
                $switch = $_POST['chooseSwitch'];
                //$conf = $_POST['chooseConf'];

                // $sql = "SELECT switches.switchID, switchConfigs.configID, switchConfigs.filename ";
                // $sql .= "FROM switches INNER JOIN switchConfigs ON switches.switchID = switchConfigs.switch ";
                // $sql .= "WHERE authoritative = 0 AND switchID = $switch";
                $sql = "SELECT switches.switchID, switches.switchName, switchConfigs.configID, switchConfigs.logTime, ";
                $sql .= "switchConfigs.filename, siteAgents.siteName ";
                $sql .= "FROM switches LEFT JOIN switchConfigs ON switches.switchID = switchConfigs.switch ";
                $sql .= "INNER JOIN siteAgents ON switches.siteAgent = siteAgents.agentID ";
                $sql .= "WHERE switchID = $switch AND authoritative = 0";

                $rs = $conn->query($sql);

                if ($rs->num_rows > 0)//
                {
                        $count = 0;

                        while($row = $rs->fetch_assoc())
                       {

                       $switchName = $row['switchName'];
                       $switchName = rtrim($switchName);

                       $siteName = $row['siteName'];
                       $siteName = rtrim($siteName);

                       $filename = $row['filename'];
                       $filename = rtrim($filename);

                       $logtime = $row['logTime'];


                       $path1 = "$siteName/$switchName/$filename";

                        //$authPath = "$siteName/$switchName/$filename";
                        //$logtime = $row['logTime'];

                        $old_path = getcwd();

                        chdir('/home/ubuntu/project/Switch/');

                       $output = shell_exec("echo $filename");

                        $line = shell_exec("cat $path1");

                        //$content = preg_split("/(\r?\n)/", $line);

                        echo "<p>$output</p>",'<br>';

                        //echo '<button class="viewing">View</button>';
                        //echo '<div class="filecontent" style="display :none">';



                        echo "<button onclick='(function(){myFunction($count);})();'>View</button>";
                        echo "<div class='configvalues$count' style='display:none'>";

                        foreach(preg_split("/((\r?\n)|(\r\n?))/", $line) as $content)
                          {
                                echo "<p>$content</p>",'<br>';
                          }
                        echo "</div>";

                        echo "<p>Log Time: $logtime</p>", '<br>';
                        $count++;
                        }
                }

                else
                {
                        $_SESSION['message'] = "There is not configuration file yet.";
                }

        }
?>

                <div>

                   <form action="viewConfigs.php">
                       <input type="submit" value="Go Back" />
                   </form>

                </div>

                 </div>
                <!--<script>

                    $(document).ready(function()
                    {
                            $("#viewing").click(function(){
                                alert("Hello! I am an alert box!!");
                                $("#filecontent").toggle();
                            });
                    });

                </script>-->


                <script>
                    function myFunction(id)
                     {
                      var x = document.getElementsByClassName("configvalues"+id);
                      for(var i = 0; i < x.length; i++)
                      {
                              if (x.item(i).style.display === "none")
                              {
                               x.item(i).style.display = "block";
                              } else {
                               x.item(i).style.display = "none";
                              }
                      }

                     }

                 </script>

              </section>
                <?php echo "<p>".$_SESSION['message']."</p>"; ?>

            </article>
       </main>
       <?php include "includes/content/footer.php"; ?>

</body>
</html>

<?php include 'security/session_variables_reset.php'; ?>