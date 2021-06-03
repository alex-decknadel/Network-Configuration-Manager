<?php
	$path = shell_exec("pwd");
	$output = shell_exec("cat includes/switchConnectionTypes.txt");

	if (strlen($output) != 0)
	{
		foreach(preg_split("/((\r?\n)|(\r\n?))/", $output) as $line)
		{
			if ($line == $connMode)
			{
				echo "<option value='$line' selected>$line</option>";
			}
			else
			{
				echo "<option value='$line'>$line</option>";
			}
		}
	}
?>