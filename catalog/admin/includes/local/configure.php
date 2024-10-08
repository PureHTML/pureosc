<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

\define('HTTP_SERVER', 'http://pureosc.local');
\define('HTTPS_SERVER', 'http://pureosc.local');
\define('ENABLE_SSL', false);
\define('HTTP_COOKIE_DOMAIN', '');
\define('HTTPS_COOKIE_DOMAIN', '');
\define('HTTP_COOKIE_PATH', 'admin');
\define('HTTPS_COOKIE_PATH', 'admin');
\define('HTTP_CATALOG_SERVER', 'http://pureosc.local');
\define('HTTPS_CATALOG_SERVER', '');
\define('ENABLE_SSL_CATALOG', 'false');
\define('DIR_FS_DOCUMENT_ROOT', '/home/f/git/pureosc.local/osc/catalog/');
\define('DIR_WS_ADMIN', '/admin/');
\define('DIR_WS_HTTPS_ADMIN', '/admin/');
\define('DIR_FS_ADMIN', '/home/f/git/pureosc.local/osc/catalog/admin/');
// TODO: \define('DIR_FS_ADMIN', __DIR__ . '/../../catalog/admin/');
\define('DIR_WS_CATALOG', '/');
\define('DIR_WS_HTTPS_CATALOG', '/');
\define('DIR_FS_CATALOG', '/home/f/git/pureosc.local/osc/catalog/');
\define('DIR_WS_IMAGES', 'images/');
\define('DIR_WS_ICONS', DIR_WS_IMAGES.'icons/');
\define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG.'images/');
\define('DIR_WS_INCLUDES', 'includes/');
\define('DIR_WS_BOXES', DIR_WS_INCLUDES.'boxes/');
\define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES.'functions/');
\define('DIR_WS_CLASSES', DIR_WS_INCLUDES.'classes/');
\define('DIR_WS_MODULES', DIR_WS_INCLUDES.'modules/');
\define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES.'languages/');
\define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG.'includes/languages/');
\define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG.'includes/languages/');
\define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG.'images/');
\define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG.'includes/modules/');
\define('DIR_FS_BACKUP', DIR_FS_ADMIN.'backups/');
\define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG.'download/');
\define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG.'pub/');

// define('DB_SERVER_ROOT_USERNAME', 'vanilla');
// define('DB_SERVER_ROOT_PASSWORD', 'osc');
\define('DB_SERVER', 'localhost');
\define('DB_PORT', '3306');
\define('DB_CHARSET', 'utf8');
\define('DB_SERVER_USERNAME', 'pureosc');
\define('DB_SERVER_PASSWORD', 'osc');
\define('DB_DATABASE', 'pureosc');
\define('USE_PCONNECT', 'false');
\define('STORE_SESSIONS', 'mysql');
// \define('SESSION_WRITE_DIRECTORY', '/home/f/git/vanilla-oscommerce/.sessions/');
\define('CFG_TIME_ZONE', 'Europe/Prague');
