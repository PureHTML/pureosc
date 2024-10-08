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
    'heading' => BOX_HEADING_CUSTOMERS,
    'apps' => [
        [
            'code' => 'customers.php',
            'title' => BOX_CUSTOMERS_CUSTOMERS,
            'link' => tep_href_link('customers.php'),
        ],
    ],
];
