<?php include 'includes/session_start.php'; ?>

<!DOCTYPE html>

<html lang="en">

<?php 
	include "includes/head.php";
	include "includes/head2.php"; 
	
	require 'includes/dbconnection.php';
	require 'includes/displayFile.php';
?>

<body>

        <?php include "includes/content/header.php"?>

        <main class="innerwrap">

                <article>

			<section>
				
				<h1>Configuration Comparison</h1>

				<div id="compareConfigs">
					<?php
						$count = 1;
						$firstindex = 1;
						$secondindex = 1;

						if ($output != "There is no difference between the two configurations.")
						{
							foreach(preg_split("/((\r?\n)|(\r\n?))/", $output) as $line)
							{
								// echo "<p>$line</p>";
								if ((preg_match("/^\*\*\*[^\*]/", $line) && $count == 1)
									|| (preg_match("/\-\-\-[^\-]/", $line) && $count == 2))
								{
									switch ($count) 
									{
										case 1:
											$array = "first";
											${$array}[0]= shell_exec("echo $line | awk '{print $3}' | awk -F/ '{print $3}'");
											break;
										case 2:
											$array = "second";
											${$array}[0] = shell_exec("echo $line | awk '{print $2}' | awk -F/ '{print $3}'");
											break;
										default:
									}

									$year = substr(${$array}[0], 0, 4);
									$month = substr(${$array}[0], 4, 2);
									$day = substr(${$array}[0], 6, 2);
									$hour = substr(${$array}[0], 8, 2);
									$minute = substr(${$array}[0], 10, 2);
									$seconds = substr(${$array}[0], 12, 2);
									${$array}[0] = "$month/$day/$year $hour:$minute:$seconds";
								}
								elseif (($count >= 5 && $count <= 35) && !preg_match("/^\-\-\-\s[0-9]/", $line))
								{
									$first[$firstindex] = $line;
									$first[$firstindex] = rtrim($first[$firstindex]);
									$first[$firstindex] = ltrim($first[$firstindex]);
									$firstindex++;
								}
								elseif ($count > 35 && !preg_match("/^\-\-\-\s[0-9]/", $line))
								{
									$second[$secondindex] = $line;
									$second[$secondindex] = rtrim($second[$secondindex]);
									$second[$secondindex] = ltrim($second[$secondindex]);
									$secondindex++;
								}

								$count++;
							}

							echo "<div class='file' id='authContent'>";
							echo "<h2>Authoritative Configuration File</h2>";
							echo "<p class='fileName'>$second[0]</p>";

							for ($i = 1; $i < count($second); $i++)
							{
								if (strlen($second[$i]) != 0)
								{
									if (preg_match("/^\!/", $second[$i]))
									{
										echo "<p class='change'>$second[$i]</p>";
									}
									elseif (preg_match("/^\+/", $second[$i]))
									{
										echo "<p class='inserted'>$second[$i]</p>";
									}
									else 
									{
										echo "<p>$second[$i]</p>";
									}
								}
							}

							echo "</div><div class='file' id='confContent'>";
							echo "<h2>Compared Configuration File</h2>";
							echo "<p class='fileName'>$first[0]</p>";

							for ($i = 1; $i < count($first); $i++)
							{
								if (strlen($first[$i]) != 0)
								{
									if (preg_match("/^\!/", $first[$i]))
									{
										echo "<p class='change'>$first[$i]</p>";
									}
									elseif (preg_match("/^\-/", $first[$i]))
									{
										echo "<p class='deleted'>$first[$i]</p>";
									}
									else 
									{
										echo "<p>$first[$i]</p>";
									}
								}
							}

							echo "</div>";
					}
					else
					{
						echo "<p>$output</p>";
					}
						
					?>
				</div>

				<div>

					<form action="viewConfigs.php" id="goback">

						<input type="submit" value="Go Back" />

					</form>

				</div>

 			</section>

                        <?php echo "<p>".$_SESSION['message']."</p>"; ?>

                </article>
        </main>

        <?php include "includes/content/footer.php"; ?>

</body>

</html>

<?php include 'security/session_variables_reset.php'; ?>