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

class session_storage
{
    public $type = 'warning';

    public function __construct()
    {
        global $language;

        include DIR_FS_ADMIN.'includes/languages/'.$language.'/modules/security_check/session_storage.php';
    }

    public function pass()
    {
        return (STORE_SESSIONS !== '') || (is_dir(tep_session_save_path()) && tep_is_writable(tep_session_save_path()));
    }

    public function getMessage()
    {
        if (STORE_SESSIONS === '') {
            if (!is_dir(tep_session_save_path())) {
                return WARNING_SESSION_DIRECTORY_NON_EXISTENT;
            }

            if (!tep_is_writable(tep_session_save_path())) {
                return WARNING_SESSION_DIRECTORY_NOT_WRITEABLE;
            }
        }
    }
}
