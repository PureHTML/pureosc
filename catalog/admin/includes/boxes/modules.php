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

$cl_box_groups[] = [
    'heading' => BOX_HEADING_MODULES,
    'apps' => [],
];

foreach ($cfgModules->getAll() as $m) {
    $cl_box_groups[\count($cl_box_groups) - 1]['apps'][] = ['code' => 'modules.php',
        'title' => $m['title'],
        'link' => tep_href_link('modules.php', 'set='.$m['code'])];
}
