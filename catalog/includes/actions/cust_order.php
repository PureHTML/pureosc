<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
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

if (isset($_SESSION['customer_id'], $_GET['pid'])) {
    if (tep_has_product_attributes($_GET['pid'])) {
        tep_redirect(tep_href_link('product_info.php', 'products_id='.$_GET['pid']));
    } else {
        $_SESSION['cart']->add_cart($_GET['pid'], $_SESSION['cart']->get_quantity($_GET['pid']) + 1);
    }
}

tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
