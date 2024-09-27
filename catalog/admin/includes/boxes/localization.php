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
    'heading' => BOX_HEADING_LOCALIZATION,
    'apps' => [
        [
            'code' => 'currencies.php',
            'title' => BOX_LOCALIZATION_CURRENCIES,
            'link' => tep_href_link('currencies.php'),
        ],
        [
            'code' => 'languages.php',
            'title' => BOX_LOCALIZATION_LANGUAGES,
            'link' => tep_href_link('languages.php'),
        ],
        [
            'code' => 'orders_status.php',
            'title' => BOX_LOCALIZATION_ORDERS_STATUS,
            'link' => tep_href_link('orders_status.php'),
        ],
    ],
];
