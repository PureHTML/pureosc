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
class extended_last_run
{
    public $type = 'warning';

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/extended_last_run.php';
    }

    public function pass()
    {
        global $PHP_SELF;

        if ($PHP_SELF === 'security_checks.php') {
            if (\defined('MODULE_SECURITY_CHECK_EXTENDED_LAST_RUN_DATETIME')) {
                tep_db_query("update configuration set configuration_value = '".tep_db_input(time())."' where configuration_key = 'MODULE_SECURITY_CHECK_EXTENDED_LAST_RUN_DATETIME'");
            } else {
                tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, date_added) values ('Security Check Extended Last Run', 'MODULE_SECURITY_CHECK_EXTENDED_LAST_RUN_DATETIME', '".tep_db_input(time())."', 'The date and time the last extended security check was performed.', '6', now())");
            }

            return true;
        }

        return \defined('MODULE_SECURITY_CHECK_EXTENDED_LAST_RUN_DATETIME') && (MODULE_SECURITY_CHECK_EXTENDED_LAST_RUN_DATETIME > strtotime('-30 days'));
    }

    public function getMessage()
    {
        return '<a href="'.tep_href_link('security_checks.php').'">'.MODULE_SECURITY_CHECK_EXTENDED_LAST_RUN_OLD.'</a>';
    }
}
