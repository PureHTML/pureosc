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
class cfgm_dashboard
{
    public $code = 'dashboard';
    public $directory;
    public $language_directory;
    public $key = 'MODULE_ADMIN_DASHBOARD_INSTALLED';
    public $title;
    public $template_integration = false;

    public function __construct()
    {
        $this->directory = DIR_FS_ADMIN.'includes/modules/dashboard/';
        $this->language_directory = DIR_FS_ADMIN.'includes/languages/';
        $this->title = MODULE_CFG_MODULE_DASHBOARD_TITLE;
    }
}
