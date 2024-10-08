<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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

\define('MODULE_SECURITY_CHECK_EXTENDED_ADMIN_BACKUP_DIRECTORY_LISTING_TITLE', 'admin/backups/ Directory Listing');
\define('MODULE_SECURITY_CHECK_EXTENDED_ADMIN_BACKUP_DIRECTORY_LISTING_HTTP_200', 'The <a href="'.tep_href_link('backups/').'" target="_blank">'.DIR_WS_ADMIN.'backups/</a> directory is publicly accessible and/or browsable - please disable directory listing for this directory in your web server configuration.');
