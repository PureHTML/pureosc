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

\define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Adresář relace neexistuje: '.tep_session_save_path().'. Sessions nebude fungovat, dokud nebude tento adresář vytvořen.');
\define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Nejsem schopen zapisovat do adresáře relace: '.tep_session_save_path().'. Sessions nebude fungovat, dokud nebude nastaveno správné uživatelské oprávnění.');
