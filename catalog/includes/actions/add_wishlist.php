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

if (isset($_GET['products_id'])) {
    $attributes = '';

    if (strpos($_GET['products_id'], '{') !== false) {
        $attributes = [];
        $attr = explode('{', substr($_GET['products_id'], strpos($_GET['products_id'], '{') + 1));

        for ($i = 0, $n = \count($attr); $i < $n; ++$i) {
            $pair = explode('}', $attr[$i]);

            if (is_numeric($pair[0]) && is_numeric($pair[1])) {
                $attributes[$pair[0]] = $pair[1];
            }
        }
    }

    $cart->add_cart($_GET['products_id'], $cart->get_quantity(tep_get_uprid($_GET['products_id'], $attributes)) + 1, $attributes);
    $wishlist->remove($_GET['products_id']);
}

tep_redirect(tep_href_link('wishlist.php', tep_get_all_get_params(['action', 'products_id'])));
