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
