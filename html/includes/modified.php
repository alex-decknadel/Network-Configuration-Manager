<?php
// $files = scandir('/home/ubuntu/project/Switch/Salem/Salem-01', SCANDIR_SORT_DESCENDING);
//8:12 to 8:35 learning scandir and getting a good output testing with php on the command line  We sort descending, so 0 is newest and 1 is older, 2 is even older.

//8:48 replacing the old command with one that automagically removes the . and .. entries and trying again..  
//Still need to find a way to "build" the path for each switch, for each site.  Starting with baby steps.
$files = array_diff( scandir("/home/ubuntu/project/Switch/Salem/Salem-01", SCANDIR_SORT_DESCENDING), array(".", "..") );
$n = count($files);
$n--;
//9:20 had to reduce the "count" of my files by one since we only compare as long as there is one more file to compare to.
// count(files) is 5 when ther are 3 files in a directory, it was counting . and .., but we have that cleared up now
print_r($files);

//8:48  Now that we have proof of listing files newest to oldest, we want to compare each file to the next file and save SOME SORT of flag when the newer file is different, I'm thinking we add a column to the switchcfg
//8:57 setting up a loop to increment down is actually a bit harder than I thought...
for ($i=0, $j=1; $i < $n; $i++, $j++)
{
	echo $files[$i].' will be compared to '.$files[$j].'<p>' ;
}
//9:22 after 70 minutes of solid plodding work, I've changed my upload script to always upload files timestamped in YYYYMMDD. I have a script that will assign the files to an array, and then loop through them.
// 9:23 $files[$i] is the "Current/newer filename and $files[$j] is the older filename.  I'm an hour in and since we can list the TIMES the configurations are uploaded... Well it's only arguably done
// The story #177650010 specifies we need to see when the configuration change occured, whcih means we need to compare 2 configs and save a flag for when they change.  I think we rated the difficulty based on
// simply displaying a user friendly timestamp FOR the configurations themselves, not the existence of a change.

//9:42 after reading about the diff, maybe I can use the diff (-q, --brief) report only when files differ option, but I am putting this on hold for tonight.
//90 minutes on a "60 minute" story with almost no progress is a good stopping point.
?>