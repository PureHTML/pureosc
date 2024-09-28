<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

\define('HTTP_SERVER', 'http://'.$_SERVER['HTTP_HOST']);
\define('HTTPS_SERVER', 'https://'.$_SERVER['HTTP_HOST']);
\define('ENABLE_SSL', false);
\define('HTTP_COOKIE_DOMAIN', '');
\define('HTTPS_COOKIE_DOMAIN', '');
\define('HTTP_COOKIE_PATH', '/');
\define('HTTPS_COOKIE_PATH', '/');
\define('DIR_WS_HTTP_CATALOG', '/');
\define('DIR_WS_HTTPS_CATALOG', '/');
\define('DIR_WS_IMAGES', 'images/');
\define('DIR_WS_ICONS', DIR_WS_IMAGES.'icons/');
\define('DIR_WS_INCLUDES', 'includes/');
\define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES.'functions/');
\define('DIR_WS_CLASSES', DIR_WS_INCLUDES.'classes/');
\define('DIR_WS_MODULES', DIR_WS_INCLUDES.'modules/');
\define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES.'languages/');

\define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
\define('DIR_FS_CATALOG', __DIR__ .  '/../../../catalog/');
\define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG.'download/');
\define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG.'pub/');

\define('DB_SERVER', 'localhost');
\define('DB_SERVER_USERNAME', 'dvere');
\define('DB_SERVER_PASSWORD', 'dvere');
\define('DB_DATABASE', 'dvere');
\define('USE_PCONNECT', 'false');
\define('STORE_SESSIONS', 'mysql');
// define('SESSION_WRITE_DIRECTORY', '/home/f/git/vanilla-oscommerce/.sessions/');
\define('CFG_TIME_ZONE', 'Europe/Prague');

// new
\define('SERVER_INSTANCE', 'admin');
