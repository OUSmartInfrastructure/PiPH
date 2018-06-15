#!/bin/sh
apt install lftp
echo "set net:reconnect-interval-base 0" >> /etc/lftp.conf
echo "set ssl:verify-certificate" >> /etc/lftp.conf
(crontab -l 2>/dev/null; echo "* * * * * /usr/local/bin/PiPH/piph.sh") | crontab -
