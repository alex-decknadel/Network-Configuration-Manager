#!/bin/bash
for dir in $(find /home/ubuntu/project/Switch -mindepth 1 -maxdepth 1 -type d)
do
	siteName=$(echo $dir | awk -F/ '{print $NF}')
	
	for subdir in $(find "$dir" -mindepth 1 -maxdepth 1 -type d)
	do
		switchName=$(echo $subdir | awk -F/ '{print $NF}')
		
		for file in $(find "$subdir" -mindepth 1 -maxdepth 1 -type f)
		do
			fileName=$(echo $file | awk -F/ '{print $NF}')
			year=${fileName:0:4}
			month=${fileName:4:2}
			day=${fileName:6:2}
			hour=${fileName:8:2}
			minute=${fileName:10:2}
			second=${fileName:12:2}
			logTime="$year-$month-$day $hour:$minute:$second"

			siteID=`sudo mysql -s -N -e "SELECT agentID FROM netcon.siteAgents WHERE siteName = '$siteName'"`
			switchID=`sudo mysql -s -N -e "SELECT switchID FROM netcon.switches WHERE switchName = '$switchName' AND siteAgent = $siteID"`
			dbConfig=`sudo mysql -s -N -e "SELECT filename FROM netcon.switchConfigs WHERE fileName = '$fileName' AND switch = $switchID"`

			if [ "$dbConfig" != "$fileName" ]
			then 
				echo "use netcon;" > insertConfig.sql
			
				query="INSERT INTO switchConfigs (filename, logTime, switch, authoritative) VALUES ('$fileName', '$logTime', $switchID, 0)"

				echo $query >> insertConfig.sql
				sudo mysql < insertConfig.sql
				rm insertConfig.sql
			fi
		done
	done
done

sudo chgrp -R www-data project
