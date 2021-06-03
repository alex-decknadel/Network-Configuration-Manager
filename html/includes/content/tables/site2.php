<?php
include 'includes/dbconnection.php';
?>
<table>
<?php
//Some good and useful knowledge!
//$rs = $conn->query($sql) Which runs the "current" $sql statement and returns rows....

//SO FOR INSTANCE:

//We could run: 
//sql command to get list of site IDs and names..
$sql="select * from siteAgents";
// Get the list of site IDs (literally siteAgents.agentID) and names(siteAgents.siteName) 
$rs=$conn->query($sql);

if ($rs->num_rows > 0)
//For each "site ID" from the first query, do something
{	
	while ($row=$rs->fetch_assoc())
	{
		echo "<tr style='background-color:#09f909'>";
//		echo "<td>".$row['siteName']."</td></tr>";
		echo "<td style='padding-left:130px;padding-top:10px;'>".$row['siteName']."</td><td></td></tr>";
				//Get the SiteID, and set it to a variable, then NEST THAT QUERY...
		$SiteID = $row['agentID'];
		$rsloop = $conn->query("SELECT admins.username from admins INNER JOIN tasks ON admins.adminID=tasks.siteAdmin WHERE tasks.siteagent=$SiteID order by admins.username");
		while ($looprow = $rsloop->fetch_assoc())
		{
//			echo "<tr><td></td><td>".$looprow['username']."</td></tr>";
			echo "<tr><td></td><td style='padding-left:640px;padding-top:10px'>".$looprow['username']."</td></tr>";
		}
		
	}
}
else 
	{
		echo "No results";
	}

		
$conn->close();

?>		 
</table>




