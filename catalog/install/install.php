<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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

require 'includes/application.php';

$page_contents = 'install.php';

if (isset($_GET['step']) && is_numeric($_GET['step'])) {
    switch ($_GET['step']) {
        case '2':
            $page_contents = 'install_2.php';

            break;
        case '3':
            $page_contents = 'install_3.php';

            break;
        case '4':
            $page_contents = 'install_4.php';

            break;
    }
}

require 'templates/main_page.php';
