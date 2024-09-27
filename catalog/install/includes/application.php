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

// Set the level of error reporting
error_reporting(\E_ALL & ~\E_NOTICE);

if (\defined('E_DEPRECATED')) {
    error_reporting(\E_ALL & ~\E_NOTICE & ~\E_DEPRECATED);
}

require 'includes/functions/compatibility.php';

require 'includes/functions/general.php';

require 'includes/functions/database.php';

require 'includes/functions/html_output.php';
