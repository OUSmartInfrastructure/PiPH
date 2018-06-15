# PiPH - Pi-Phone-Home
Pi Phone Home - System to have RasPi (or any system) relay system details to a central location on a schedule.

Needed a way to know the DHCP IPs of RasPi without access to DHCP Server logs. As they moved around to different subnets. 

This system uses SFTP (Filezilla server recommended) to have the unit push details up to the server. It creates a file based on the Pi's MAC address.

The index.php is located in the same directory as uploaded files. HTTP/PHP will need to installed for web display of data (IIS was our platform). 

lftp util needed for this to work.

sudo apt install lftp
sudo nano /etc/lftp.conf --- add lines: set net:reconnect-interval-base 0 & set ssl:verify-certificate into the bottom

sudo crontab -e --- add line:  * * * * * [path to files]

piph.conf file has following format

Host:yourftpsserver.com

Username:pi

Password:raspberry

Interface:eth0
