$dt= get-date -Format "yyyyMMddHHmmss"
h:\cfg\script1.bat
timeout /T 3
rename-item h:\cfg\switch\Woodburn-01\running.txt -NewName $dt
h:\cfg\scpupload.bat