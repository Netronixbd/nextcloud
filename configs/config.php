<?php

/*
 * WARNING
 *
 * This file gets modified by automatic processes and all lines that are not
 * active code (ie. comments) are lost during that process.
 *
 * If you want to document things with comments or use constants add your settings
 * in a '<NAME>.config.php' file which will be included and rendered into this file.
 *
 * Example:
 *   <?php
 *   $CONFIG = [];
 *
 * See also: https://docs.nextcloud.com/server/latest/admin_manual/configuration_server/config_sample_php_parameters.html#multiple-merged-configuration-files
 */
$CONFIG = array (
  'trusted_domains' => 
  array (
    0 => 'cloud.antubroadband.com',
  ),
  'htaccess.RewriteBase' => '/',
  'memcache.local' => '\\OC\\Memcache\\APCu',
  'apps_paths' => 
  array (
    0 => 
    array (
      'path' => '/var/www/html/apps',
      'url' => '/apps',
      'writable' => false,
    ),
    1 => 
    array (
      'path' => '/var/www/html/custom_apps',
      'url' => '/custom_apps',
      'writable' => true,
    ),
  ),
  'upgrade.disable-web' => true,
  'instanceid' => 'ocapzq2yc2hd',
  'passwordsalt' => '1jWRMHziIi6GeUolVsCpN34jiBTXhc',
  'secret' => 'X7Py8jqNK0iccEn0XfkNOHhFm2I9a0EJsVySHuUILBYRhXpP',
  'datadirectory' => '/var/www/html/data',
  'dbtype' => 'mysql',
  'version' => '34.0.4.1',
  'overwrite.cli.url' => 'http://cloud.antubroadband.com',
  'dbname' => 'nextcloud',
  'dbhost' => 'db',
  'dbtableprefix' => 'oc_',
  'mysql.utf8mb4' => true,
  'dbuser' => 'nextcloud',
  'dbpassword' => 'nextcloudpassword',
  'installed' => true,
);
