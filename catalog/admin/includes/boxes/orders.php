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
    'heading' => BOX_HEADING_ORDERS,
    'apps' => [
        [
            'code' => 'orders.php',
            'title' => BOX_ORDERS_ORDERS,
            'link' => tep_href_link('orders.php'),
        ],
    ],
];
