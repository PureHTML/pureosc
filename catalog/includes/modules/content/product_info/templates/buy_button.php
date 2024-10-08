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

$price_show = 0;

if ($product_info['products_quantity'] > (int) \constant('STOCK_REORDER_LEVEL')) {
    $products_price = $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
    $pattern = '/[a-zč $]*/i';
    $replacement = '';

    if (preg_replace($pattern, $replacement, $products_price) !== '0') {
        $price_show = 1;
    }
}

if ($price_show === 1) {
    echo tep_draw_hidden_field('products_id', $product_info['products_id']).tep_draw_button(IMAGE_BUTTON_IN_CART, 'cart', null, 'btn-primary');
} else {
    echo '<a href="'.tep_href_link('contact_us.php?products_id='.$product_info['products_id']).'">poptavka</a>';
}
