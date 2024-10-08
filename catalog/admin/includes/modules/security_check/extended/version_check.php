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
class extended_version_check
{
    public $type = 'warning';
    public $has_doc = true;

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/extended/version_check.php';

        $this->title = MODULE_SECURITY_CHECK_EXTENDED_VERSION_CHECK_TITLE;
    }

    public function pass()
    {
        $cache_file = DIR_FS_CACHE.'oscommerce_version_check.cache';

        return file_exists($cache_file) && (filemtime($cache_file) > strtotime('-30 days'));
    }

    public function getMessage()
    {
        return '<a href="'.tep_href_link('version_check.php').'">'.MODULE_SECURITY_CHECK_EXTENDED_VERSION_CHECK_ERROR.'</a>';
    }
}
