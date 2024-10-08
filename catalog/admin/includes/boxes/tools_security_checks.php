<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
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

foreach ($cl_box_groups as &$group) {
    if ($group['heading'] === BOX_HEADING_TOOLS) {
        $group['apps'][] = ['code' => 'security_checks.php',
            'title' => MODULES_ADMIN_MENU_TOOLS_SECURITY_CHECKS,
            'link' => tep_href_link('security_checks.php')];

        break;
    }
}
