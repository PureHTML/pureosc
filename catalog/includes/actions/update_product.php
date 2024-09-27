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

for ($i = 0, $n = \count($_POST['products_id']); $i < $n; ++$i) {
    if (isset($_POST['cart_delete']) && \in_array($_POST['products_id'][$i], \is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : [], true)) {
        $_SESSION['cart']->remove($_POST['products_id'][$i]);
    } else {
        $attributes = (isset($_POST['id'][$_POST['products_id'][$i]])) ? $_POST['id'][$_POST['products_id'][$i]] : '';
        $_SESSION['cart']->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, false);
    }
}

tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
