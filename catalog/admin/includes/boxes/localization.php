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
