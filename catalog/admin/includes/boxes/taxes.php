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
    'heading' => BOX_HEADING_LOCATION_AND_TAXES,
    'apps' => [
        [
            'code' => 'countries.php',
            'title' => BOX_TAXES_COUNTRIES,
            'link' => tep_href_link('countries.php'),
        ],
        [
            'code' => 'zones.php',
            'title' => BOX_TAXES_ZONES,
            'link' => tep_href_link('zones.php'),
        ],
        [
            'code' => 'geo_zones.php',
            'title' => BOX_TAXES_GEO_ZONES,
            'link' => tep_href_link('geo_zones.php'),
        ],
        [
            'code' => 'tax_classes.php',
            'title' => BOX_TAXES_TAX_CLASSES,
            'link' => tep_href_link('tax_classes.php'),
        ],
        [
            'code' => 'tax_rates.php',
            'title' => BOX_TAXES_TAX_RATES,
            'link' => tep_href_link('tax_rates.php'),
        ],
    ],
];
