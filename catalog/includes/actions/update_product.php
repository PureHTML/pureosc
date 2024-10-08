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

for ($i = 0, $n = \count($_POST['products_id']); $i < $n; ++$i) {
    if (isset($_POST['cart_delete']) && \in_array($_POST['products_id'][$i], \is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : [], true)) {
        $_SESSION['cart']->remove($_POST['products_id'][$i]);
    } else {
        $attributes = (isset($_POST['id'][$_POST['products_id'][$i]])) ? $_POST['id'][$_POST['products_id'][$i]] : '';
        $_SESSION['cart']->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, false);
    }
}

tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
