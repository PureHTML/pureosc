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
    'heading' => BOX_HEADING_CATALOG,
    'apps' => [
        [
            'code' => 'categories.php',
            'title' => BOX_CATALOG_CATEGORIES_PRODUCTS,
            'link' => tep_href_link('categories.php'),
        ],
        [
            'code' => 'products_attributes.php',
            'title' => BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES,
            'link' => tep_href_link('products_attributes.php'),
        ],
        [
            'code' => 'manufacturers.php',
            'title' => BOX_CATALOG_MANUFACTURERS,
            'link' => tep_href_link('manufacturers.php'),
        ],
        [
            'code' => 'reviews.php',
            'title' => BOX_CATALOG_REVIEWS,
            'link' => tep_href_link('reviews.php'),
        ],
        [
            'code' => 'specials.php',
            'title' => BOX_CATALOG_SPECIALS,
            'link' => tep_href_link('specials.php'),
        ],
        [
            'code' => 'products_expected.php',
            'title' => BOX_CATALOG_PRODUCTS_EXPECTED,
            'link' => tep_href_link('products_expected.php'),
        ],
    ],
];
