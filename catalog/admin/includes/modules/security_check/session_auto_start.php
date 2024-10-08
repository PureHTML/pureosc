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
class session_auto_start
{
    public $type = 'warning';

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/session_auto_start.php';
    }

    public function pass()
    {
        return (bool) \ini_get('session.auto_start') === false;
    }

    public function getMessage()
    {
        return WARNING_SESSION_AUTO_START;
    }
}
