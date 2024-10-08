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

/**
 * This file is part of the DvereCOM package.
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class extended_mysql_utf8
{
    public $type = 'warning';
    public $has_doc = true;

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/extended/mysql_utf8.php';

        $this->title = MODULE_SECURITY_CHECK_EXTENDED_MYSQL_UTF8_TITLE;
    }

    public function pass()
    {
        $check_query = tep_db_query('show table status');

        if (tep_db_num_rows($check_query) > 0) {
            while ($check = tep_db_fetch_array($check_query)) {
                if (isset($check['Collation']) && ($check['Collation'] !== 'utf8mb4_unicode_ci')) {
                    return false;
                }
            }
        }

        return true;
    }

    public function getMessage()
    {
        return '<a href="'.tep_href_link('database_tables.php').'">'.MODULE_SECURITY_CHECK_EXTENDED_MYSQL_UTF8_ERROR.'</a>';
    }
}
