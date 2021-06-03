sudo apt-get update
sudo apt-get upgrade
sudo apt-get install lamp-server^
sudo chgrp -R www-data /var/www/html
sudo usermod -aG www-data ubuntu
sudo mysql < run.sql
