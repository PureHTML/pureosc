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

class extended_https
{
    public $type = 'warning';

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/extended/https.php';

        $this->title = MODULE_SECURITY_CHECK_EXTENDED_HTTPS_TITLE;
    }

    public function pass()
    {
        return \defined('ENABLE_SSL') && ENABLE_SSL === true;
    }

    public function getMessage()
    {
        return MODULE_SECURITY_CHECK_EXTENDED_HTTPS_ERROR;
    }
}
