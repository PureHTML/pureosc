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

$cl_box_groups[] = [
    'heading' => BOX_HEADING_CONFIGURATION,
    'apps' => [
        [
            'code' => 'administrators.php',
            'title' => BOX_CONFIGURATION_ADMINISTRATORS,
            'link' => tep_href_link('administrators.php'),
        ],
        [
            'code' => 'store_logo.php',
            'title' => BOX_CONFIGURATION_STORE_LOGO,
            'link' => tep_href_link('store_logo.php'),
        ],
    ],
];

$configuration_groups_query = tep_db_query("select configuration_group_id as cgID, configuration_group_title as cgTitle from configuration_group where visible = '1' order by sort_order");

while ($configuration_groups = tep_db_fetch_array($configuration_groups_query)) {
    $cl_box_groups[\count($cl_box_groups) - 1]['apps'][] = [
        'code' => 'configuration.php',
        'title' => $configuration_groups['cgTitle'],
        'link' => tep_href_link('configuration.php', 'gID='.$configuration_groups['cgID']),
    ];
}
