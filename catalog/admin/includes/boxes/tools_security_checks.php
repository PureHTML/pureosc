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
    if ($group['heading'] === BOX_HEADING_TOOLS) {
        $group['apps'][] = ['code' => 'security_checks.php',
            'title' => MODULES_ADMIN_MENU_TOOLS_SECURITY_CHECKS,
            'link' => tep_href_link('security_checks.php')];

        break;
    }
}
