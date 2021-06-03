var request = null;

function getCurrentTime() 
{
	request = new XMLHttpRequest();
	var timeurl = "includes/content/time.php";
	request.open("GET", timeurl, true);
	request.onreadystatechange = updateTime;
	request.send(null);
}

function updateTime()
{
	if (request.readyState == 4)
	{	
		var timeDisplay = document.getElementById("time");
		timeDisplay.innerHTML = request.responseText;
	}
}
