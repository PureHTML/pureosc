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
    'heading' => BOX_HEADING_REPORTS,
    'apps' => [
        [
            'code' => 'stats_products_purchased.php',
            'title' => BOX_REPORTS_PRODUCTS_PURCHASED,
            'link' => tep_href_link('stats_products_purchased.php'),
        ],
        [
            'code' => 'stats_customers.php',
            'title' => BOX_REPORTS_ORDERS_TOTAL,
            'link' => tep_href_link('stats_customers.php'),
        ],
    ],
];
