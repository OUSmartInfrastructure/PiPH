#!/bin/sh
apt install lftp
chmod +x piph.sh
echo "set net:reconnect-interval-base 0" >> /etc/lftp.conf
echo "set ssl:verify-certificate-no" >> /etc/lftp.conf
(crontab -l 2>/dev/null; echo "* * * * * /usr/local/bin/PiPH/piph.sh") | crontab -
