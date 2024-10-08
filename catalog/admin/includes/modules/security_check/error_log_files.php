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
class error_log_files
{
    public $type = 'warning';

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/error_log_files.php';

        $this->title = MODULE_SECURITY_CHECK_ERROR_LOG_FILES_TITLE;
    }

    public function pass()
    {
        if (is_dir(DIR_FS_CATALOG.'includes/work/error_logs') && is_writable(DIR_FS_CATALOG.'includes/work/error_logs')) {
            if (\count(glob(DIR_FS_CATALOG.'includes/work/error_logs/errors-*.txt')) > 0) {
                return false;
            }
        }

        return true;
    }

    public function getMessage()
    {
        return '<a href="'.tep_href_link('error_log.php').'">'.WARNING_ERROR_LOG_FILES_EXIST.'</a>';
    }
}
