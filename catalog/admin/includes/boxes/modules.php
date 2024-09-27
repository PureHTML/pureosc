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

$cl_box_groups[] = [
    'heading' => BOX_HEADING_MODULES,
    'apps' => [],
];

foreach ($cfgModules->getAll() as $m) {
    $cl_box_groups[\count($cl_box_groups) - 1]['apps'][] = ['code' => 'modules.php',
        'title' => $m['title'],
        'link' => tep_href_link('modules.php', 'set='.$m['code'])];
}
