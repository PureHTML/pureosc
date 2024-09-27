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

if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
    $attributes = $_POST['id'] ?? '';
    $_SESSION['cart']->add_cart($_POST['products_id'], $_SESSION['cart']->get_quantity(tep_get_uprid($_POST['products_id'], $attributes)) + 1, $attributes);
}

tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
