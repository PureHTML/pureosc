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

class default_language
{
    public $type = 'error';

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/default_language.php';
    }

    public function pass()
    {
        return \defined('DEFAULT_LANGUAGE');
    }

    public function getMessage()
    {
        return ERROR_NO_DEFAULT_LANGUAGE_DEFINED;
    }
}
