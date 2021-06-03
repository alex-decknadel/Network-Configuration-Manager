# Code Dictionary

## MYSQL Data

- *admins:* 
	1. Description: Site admins and head admins.
	2. Columns:
		- adminID: UID for admin in database.
			1. Used by:
				- 
				- 
		- username
			1. Used by:
				- authorize.php
				- 
		- email
			1. Used by:
				-
		- password
			1. Used by:
				- authorize.php
		- adminType
			1. Used by:
				- authorize.php
	3. Keys:
		- Primary Key: adminID

- *tasks:*
	1. Description: Relationship between a single admin and a single site agent.
	2. Columns:
		- taskID
			1. Description: UID for tasks in database.
			2. Used by:
				-
		- siteAdmin
			1. Description: Site admin who is assigned a site.
			2. Used by:
				-
		- siteAgent
			1. Description: Site agent assigned to a site admin.
			2. Used by:
				-
	3. Keys:
		- Primary Key: taskID
		- Foreign Keys: siteAgent and siteAdmin

- *siteAgents:*
	1. Description: Used to reference the agent that manages a site.
	2. Columns:
		- agentID: UID for site agent in database.
			1. Used by:
				-
		- siteName: Given name for site.
			1. Used by:
				-
		-
	3. Keys:
		- Primary Key: agentID

- *switches*
	1. Description: Switches that exist in a site.
	2. Columns:
		- switchID
			1. Description: UID for switches in database.
			2. Used by:
				-
		- switchName 
			1. Description: Given name for switch.
			2. Used by:
				-
		- ipAddress
			1. Description: logged IP address of the switch.
			2. Used by:
				-
		- connectionMode
			1. Description: Protocol used to connect to switch.
			2. Used by:
				-
		- authenticationString
			1. Description: Login password for switch.
			2. Used by:
				-
		- siteAgent
			1. Description: The site the switch is used on.
			2. Used by:
				-
	3. Keys:
		- Primary Key: switchID
		- Foreign Key: siteAgent
			

- *switchConfigs*
	1. Description: Switch configurations that exist for a switch.
	2. Columns:
		- configID
			1. Description: UID for switch configurations in database.
			2. Used by:
				-
		- filename 
			1. Description: The name of the configuration file.
			2. Used by:
				-
		- logTime 
			1. Description: The time the configuration file was created.
			2. Used by:
				-
		- switch 
			1. Description: The switch the configuration file is for.
			2. Used by:
				-
	3. Keys:
		- Primary Key: configID
		- Foreign Key: switch

- *notifications*
	1. Description: Notifications that are generated on the web server.
	2. Columns:
		- adminID: UID for admin in database
			1. Used by:
				-
		- username
			1. Used by:
				-
		- email
			1. Used by:
				-
		- password
			1. Used by:
				-
		- adminType
			1. Used by:
				-
	3. Keys:
		- Primary Key: noteID
		- Foreign Key: siteAdmin

## Web Application Main Pages

- **index.php**
	1. Creator: Alex Decknadel
	2. Description: Landing page for web application; main menu.
	3. Variables used:
		- $\_SESSION['adminType']
			1. Value = $rowType from authorize.php
			2. Description: A count variable for use in a loop
	4. Included or required PHP pages:
		- session_start.php
		- head.php
		- head2.php
		- header.php
		- headMenu.php
		- footer.php
		- session_variables_reset.php
	5. Links:
		- Index.css
		- viewSwitches.php

- **login.php**
	1. Creator: Alex Decknadel
	2. Description: Login portal for web application.
	3. Variables used:
		- $\_SESSION['message']
			1. Value = "" or $\_SESSION['message'] from authorize.php
			2. Description: A count variable for use in a loop
		- $\_SESSION['timedateRefreshCount']
			1. Value = 0
			2. Description: A count variable for use in a loop
		- $\_SESSION['username']
			1. Value = $rowUser from authorize.php
			2. Description: A count variable for use in a loop
	4. Form actions:
		- authorize.php

- **displayConfig.php**
	1. Creator: Alex Decknadel
	2. Description: Displays a configuration file by itself.
	3. Variables used:
		- $output = $output from displayFile.php
		- $line = preg_split("/((\r?\n)|(\r\n?))/", $output)
	4. Form actions:
		- viewConfigs.php
	5. Included or required PHP pages:
		- session_start.php
		- head.php
		- head2.php
		- dbconnection.php
		- displayFile.php
		- header.php
		- headMenu.php
		- footer.php
		- session_variables_reset.php

- **comparisons.php**
	1. Creator: Alex Decknadel
	2. Description: Shows a comparison between two files.
	3. Variables used:
		- $count
			1. Description: A count variable for use in a loop.
			2. Value = 1 or $count++
		- $firstIndex
			1. Description: A variable to specify an index in an array.
			2. Value = 1 or $firstIndex++
		- $secondIndex
			1. Description: A variable to specify an index in an array.
			2. Value = 1 or $secondIndex++
		- $line
			1. Description: The current line being outputted from $output.
			2. Value = preg_split("/((\r?\n)|(\r\n?))/", $output)
		- $output
			1. Description: The result of a shell command.
			2. Value = $output from displayFile.php
		- $array
			1. Description: Holds the name of an array
			2. Value = "first" or "second"
		- ${array}
			1. Description: A variable to specify an index in an array
			2. Value = $first[] or $second[]
		- $year
			1. Description: A variable to specify the year
			2. Value = substr(${$array}[0], 0, 4)
		- $month
			1. Description: A variable to specify the month
			2. Value = substr(${$array}[0], 4, 2)
		- $day
			1. Description: A variable to specify the day
			2. Value = substr(${$array}[0], 6, 2)
		- $hour
			1. Description: A variable to specify part of the time
			2. Value = substr(${$array}[0], 8, 2)
		- $minute
			1. Description: A variable to specify part of the time
			2. Value = substr(${$array}[0], 10, 2)
		- $seconds
			1. Description: A variable to specify part of the time
			2. Value = substr(${$array}[0], 12, 2)
		- ${$array}[0]
			1. Description: A variable to specify the first index in an array
			2. Value = "$month/$day/$year $hour:$minute:$seconds"
		- $first[$firstindex]
			1. Description: A variable to specify an index in an array
			2. Value = $line
		- $second[$secondindex]
			1. Description: A variable to specify an index in an array
			2. Value = $line
	4. Form actions:
		- viewConfigs.php
	5. Included or required PHP files:
		- head.php
		- head2.php
		- dbconnection.php
		- displayFile.php
		- header.php
		- footer.php
		- session_variables_reset.php

- **assignAdmins.php**
	1. Creator: Alex Decknadel
	2. Description: Displays a configuration file by itself.
	3. Variables used:
		- $\_SESSION['admin']
			1. Description: A variable to specify an index in an array
			2. Value = adminID from *admins*
		-$\_SESSION['message']
			1. Description: A variable to specify an index in an array
			2. Value = "" or ""
		-$\_SESSION['timedateRefreshCount']
			1. Description: A variable to specify an index in an array
			2. Value = 
		-$\_SESSION['username']
			1. Description: A variable to specify an index in an array
			2. Value = 

- **siteAdmins.php**
	1. Creator: Alex Decknadel
	2. Description: Displays a configuration file by itself.
	3. Variables used:
		- $\_SESSION['admin']
			1. Description: A variable to specify an index in an array
			2. Value = adminID from *admins*
		- $\_SESSION['message']
			1. Description: A variable to specify an index in an array
			2. Value = "" or ""
		- $\_SESSION['timedateRefreshCount']
			1. Description: A variable to specify an index in an array
			2. Value = 
		- $\_SESSION['username']
			1. Description: A variable to specify an index in an array
			2. Value = 

- **sites.php**
	- Creator: Alex Decknadel

- **sites2.php**
	- Creator: 

- **viewConfigs.php**
	- Creator: Alex Decknadel

- **viewSwitches.php**
	- Creator: Alex Decknadel

- **listc.php**
	- Creator: 

- **listConfigs.php**
	- Creator: 

- **listConfigstest.php**
	- Creator: 

## Web Application Includes

- assignAdmins.php
	- Creator: Alex Decknadel

- assignAuthoritative.php
	- Creator: Alex Decknadel

- confirmed.php
	- Creator: Alex Decknadel

- dbconnection.php
	- Creator: Alex Decknadel

- delete.php
	- Creator: Alex Decknadel

- displayFile.php
	- Creator: Alex Decknadel

- dupes.php
	- Creator: Alex Decknadel

- head.php
	- Creator: Alex Decknadel

- head2.php
	- Creator: Alex Decknadel

- logoff.php
	- Creator: Alex Decknadel

- modified.php
	- Creator:

- session_start.php
	- Creator: Alex Decknadel

### content

- footer.php
	- Creator: Alex Decknadel

- header.php
	- Creator: Alex Decknadel

- headMenu.php
	- Creator: Alex Decknadel

- time.php
	- Creator: Alex Decknadel

#### headerContent

- headAdmin.php
	- Creator: Alex Decknadel

- loginHeader.php
	- Creator: Alex Decknadel

- noHeader.php
	- Creator: Alex Decknadel

- siteAdmin.php
	- Creator: Alex Decknadel

#### options

- admins.php
	- Creator: Alex Decknadel

- configs.php
	- Creator: Alex Decknadel

- sites.php
	- Creator: Alex Decknadel

- switches.php
	- Creator: Alex Decknadel

#### tables

- configs.php
	- Creator: Alex Decknadel

- listSites.php
	- Creator: Alex Decknadel

- site2.php
	- Creator: 

- siteAdmins.php
	- Creator: Alex Decknadel

- sites.php
	- Creator: Alex Decknadel

- switches.php
	- Creator: Alex Decknadel

## Web Application Security

- authorize.php
	- Creator: Alex Decknadel

- session_variable_reset.php
	- Creator: Alex Decknadel

## Web Application Common

### art

- fpo.png

### css

- default.css

- reset.css

- styles.css
	- Creator: Alex Decknadel

#### pages

- index.css
	- Creator: Alex Decknadel

- adminAssign.css
	- Creator: Alex Decknadel

- login.css
	- Creator: Alex Decknadel

### js

- jquery-3.1.1.min.js

- jquery-3.1.1.min.map

- lib.js

- timestamp.js
	- Creator: Alex Decknadel

- updateTime.js
	- Creator: Alex Decknadel