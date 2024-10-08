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
