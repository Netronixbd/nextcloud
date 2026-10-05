#!/bin/bash
set -e
echo "[+] Updating system packages..."
apt update && apt upgrade -y

echo "[+] Installing PHP, Database, and Web server dependencies..."
apt install -y nginx mariadb-server curl unzip \
php-fpm php-mysql php-gd php-curl php-mbstring php-xml php-zip php-intl php-bcmath php-gmp php-imagick

echo "[+] Downloading and extracting Nextcloud..."
curl -fsSL https://download.nextcloud.com/server/releases/latest.zip -o /tmp/nextcloud.zip
unzip -q /tmp/nextcloud.zip -d /var/www/

echo "[+] Setting up permissions and data folder..."
mkdir -p /var/www/nextcloud-data
chown -R www-data:www-data /var/www/nextcloud/ /var/www/nextcloud-data/
chmod -R 755 /var/www/nextcloud/

echo "[+] Nextcloud directory ready at /var/www/nextcloud."
echo "[+] Copy configurations from configs/ to your server paths and set up DB."
