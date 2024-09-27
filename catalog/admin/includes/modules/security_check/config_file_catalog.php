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

class config_file_catalog
{
    public $type = 'warning';

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/config_file_catalog.php';
    }

    public function pass()
    {
        return file_exists(DIR_FS_CATALOG.'includes/configure.php') && !tep_is_writable(DIR_FS_CATALOG.'includes/configure.php');
    }

    public function getMessage()
    {
        return WARNING_CONFIG_FILE_WRITEABLE;
    }
}
