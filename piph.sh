#!/bin/sh
#
#Util to have Pi phone home
#
# Need to install lftp for this to work.
#sudo apt install lftp
#sudo nano /etc/lftp.conf --- add lines: set net:reconnect-interval-base 0 & set ssl:verify-certificate into the bottom
#sudo crontab -e --- add line:  * * * * * [path to files]

#Set execute on piph.sh
#sudo chmod +x piph.sh

#piph.conf file has following format
#Host:yourftpsserver.com
#Username:pi
#Password:raspberry
#Interface:eth0

#To run application sudo is needed.
#sudo ./piph.sh

conf_file=/usr/local/bin/PiPH/piph.conf
interface=$(sed '4q;d' $conf_file | cut -d':' -f 2)
Host=$(sed '1q;d' $conf_file | cut -d':' -f 2)
Username=$(sed '2q;d' $conf_file | cut -d':' -f 2)
Password=$(sed '3q;d' $conf_file | cut -d':' -f 2)
IP=$(ip addr show $interface | awk '/inet / {print $2}' | cut -d/ -f 1)
MAC=$(ip link show $interface | awk '/ether/ {print $2}')
Uptime=$(awk '{print $1}' /proc/uptime)
Hostname=$(hostname)
MAC_1=$(echo $MAC | tr ':' '-')

echo "Hostname: $Hostname"
echo "IP Address: $IP"
echo "MAC Address: $MAC"
echo "Seconds Since Boot: $Uptime"
echo $IP','$Hostname','$MAC','$Uptime > /usr/local/bin/PiPH/$MAC_1.txt

lftp <<SCRIPT
set ftps:initial-prot P
set ftp:ssl-force true
set ftp:ssl-protect-data true
open $Host
user $Username $Password
ls
put /usr/local/bin/PiPH/$MAC_1.txt
exit
SCRIPT
