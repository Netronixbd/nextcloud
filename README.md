# ☁️ Automated Nextcloud Deployment & Configuration Backup

This repository contains automated installation scripts and production configuration backups for deploying and restoring **Nextcloud** on Ubuntu systems.

Anyone can use this repository to replicate a stable, production-ready Nextcloud instance on Ubuntu 22.04 / 24.04 LTS within minutes.

---

## 📋 Prerequisites

* **Operating System:** Ubuntu 22.04 LTS or Ubuntu 24.04 LTS
* **Hardware Specs:**
  * Minimum: 2 GB RAM, 2 vCPUs
  * Recommended: 4 GB+ RAM, 4 vCPUs
* **Storage:** Dedicated SSD/HDD mount point (e.g., `/mnt/hdd`)
* **Privileges:** `root` or user account with `sudo` permissions

---

## 🚀 Quick Deployment Guide

### Step 1: Update System & Clone Repository

Connect to your Ubuntu server and clone this repository:

```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y git curl

git clone https://github.com/Netronixbd/nextcloud.git
cd nextcloud
```

---

### Step 2: Run Deployment Script

Execute `deploy.sh` to install all necessary packages (Web server, MariaDB, PHP extensions) and download the latest Nextcloud release:

```bash
chmod +x deploy.sh
sudo ./deploy.sh
```

---

### Step 3: Configure MariaDB Database

Access your MariaDB command prompt:

```bash
sudo mariadb -u root
```

Execute the following queries to create the database and assign privileges. Replace `'STRONG_PASSWORD_HERE'` with your preferred secure database password:

```sql
CREATE DATABASE nextcloud CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
CREATE USER 'nextclouduser'@'localhost' IDENTIFIED BY 'STRONG_PASSWORD_HERE';
GRANT ALL PRIVILEGES ON nextcloud.* TO 'nextclouduser'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

### Step 4: Apply Configuration Files

Apply your backed-up settings from the `configs/` folder:

```bash
# Copy primary config.php
sudo cp configs/config.php /var/www/nextcloud/config/config.php

# Apply correct ownership and filesystem permissions
sudo chown -R www-data:www-data /var/www/nextcloud/
sudo chmod -R 755 /var/www/nextcloud/
```

> **Note on Storage Paths:**  
> If your data directory is mounted on a secondary partition or drive (e.g., `/mnt/hdd/html`), ensure the `'datadirectory'` value in `config.php` points to that path and ownership belongs to `www-data`:
> ```bash
> sudo chown -R www-data:www-data /mnt/hdd/
> sudo chmod -R 750 /mnt/hdd/
> ```

---

### Step 5: Web Server Setup & Service Reload

#### For Nginx:
```bash
sudo cp configs/nginx/* /etc/nginx/conf.d/ 2>/dev/null || true
sudo nginx -t
sudo systemctl restart nginx
sudo systemctl restart php*-fpm
```

#### For Apache:
```bash
sudo a2enmod rewrite headers env dir mime setenvif
sudo systemctl restart apache2
```

---

### Step 6: Access Nextcloud

Open your web browser and navigate to your server's IP address or domain:

```text
http://YOUR_SERVER_IP
# or
http://your-domain.com
```

---

## 📁 Repository Structure

```text
nextcloud/
├── deploy.sh              # Automated dependency installer & setup script
├── README.md              # Deployment guide and documentation
└── configs/               # Production configuration files
    ├── config.php         # Nextcloud application configuration
    ├── nginx/             # Nginx reverse proxy / virtual host configs
    └── apache2/           # Apache virtual host configs
```

---

## 🛡️ Post-Installation & Security Recommendations

1. **Enable SSL/TLS (HTTPS):**
   Secure your domain using Let's Encrypt certificates:
   ```bash
   sudo apt install -y certbot python3-certbot-nginx
   sudo certbot --nginx -d your-domain.com
   ```
2. **Setup Background Jobs (Cron):**
   Switch Nextcloud background job mode to **Cron**:
   ```bash
   sudo crontab -u www-data -e
   ```
   Add this line to run jobs every 5 minutes:
   ```cron
   */5 * * * * php -f /var/www/nextcloud/cron.php
   ```
3. **Memory Caching (Redis):**
   Install Redis cache for high file-throughput performance and memory caching.

---

## 👨‍💻 Author & Credits

* **Developer:** [Amir Hosan (Netronixbd)](https://github.com/Netronixbd)
* **Email:** amirhosan1@outlook.com
* **Organization:** [Netronixbd](https://github.com/Netronixbd)

---

## 📄 License

This repository is maintained by Netronixbd for automated server deployment, disaster recovery, and infrastructure standardization.
