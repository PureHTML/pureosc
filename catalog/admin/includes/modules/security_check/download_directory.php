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
class download_directory
{
    public $type = 'warning';

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/download_directory.php';
    }

    public function pass()
    {
        if (DOWNLOAD_ENABLED !== 'true') {
            return true;
        }

        // backwards compatibility <2.2RC3; DIR_FS_DOWNLOAD not in configure.php
        if (!\defined('DIR_FS_DOWNLOAD')) {
            return true;
        }

        return is_dir(DIR_FS_DOWNLOAD);
    }

    public function getMessage()
    {
        return WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT;
    }
}
