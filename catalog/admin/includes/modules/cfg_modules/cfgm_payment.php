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
class cfgm_payment
{
    public $code = 'payment';
    public $directory;
    public $language_directory = DIR_FS_CATALOG_LANGUAGES;
    public $key = 'MODULE_PAYMENT_INSTALLED';
    public $title;
    public $template_integration = false;

    public function __construct()
    {
        $this->directory = DIR_FS_CATALOG_MODULES.'payment/';
        $this->title = MODULE_CFG_MODULE_PAYMENT_TITLE;
    }
}
