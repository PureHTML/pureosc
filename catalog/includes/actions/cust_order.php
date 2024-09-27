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

if (isset($_SESSION['customer_id'], $_GET['pid'])) {
    if (tep_has_product_attributes($_GET['pid'])) {
        tep_redirect(tep_href_link('product_info.php', 'products_id='.$_GET['pid']));
    } else {
        $_SESSION['cart']->add_cart($_GET['pid'], $_SESSION['cart']->get_quantity($_GET['pid']) + 1);
    }
}

tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
