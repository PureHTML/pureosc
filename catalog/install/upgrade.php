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

require 'includes/application.php';

$page_contents = 'upgrade.php';

if (isset($_GET['step']) && is_numeric($_GET['step'])) {
    switch ($_GET['step']) {
        case '2':
            $page_contents = 'upgrade_2.php';

            break;
        case '3':
            $page_contents = 'upgrade_3.php';

            break;
        case '4':
            $page_contents = 'upgrade_4.php';

            break;
    }
}

require 'templates/main_page.php';
