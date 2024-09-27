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

foreach ($cl_box_groups as &$group) {
    if ($group['heading'] === BOX_HEADING_CATALOG) {
        $group['apps'][] = ['code' => 'information.php',
            'title' => MODULES_ADMIN_MENU_CATALOG_INFORMATION,
            'link' => tep_href_link('information.php')];

        break;
    }
}
