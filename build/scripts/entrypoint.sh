#!/bin/sh
PATH=/usr/local/sbin:/usr/local/bin:/sbin:/bin:/usr/sbin:/usr/bin

printenv >>/etc/environment

HOST_DOMAIN="host.docker.internal"
ping -q -c1 $HOST_DOMAIN > /dev/null 2>&1
if [ $? -ne 0 ]; then
  HOST_IP=$(ip route | awk 'NR==1 {print $3}')
  echo "$HOST_IP $HOST_DOMAIN" >> /etc/hosts
fi

echo "$(date): init start"
php /var/www/html/artisan storage:link
php /var/www/html/artisan view:clear
php /var/www/html/artisan route:clear

chown -R www-data:www-data /var/www/html/storage
chmod -R 775 /var/www/html/storage
echo "$(date): init end"

exec "$@"
