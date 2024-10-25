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

class shop_shopping_cart_alternative_checkout_buttons
{
    public function listen_displayAlternativeCheckoutButtons()
    {
        global $payment_modules;

        $initialize_checkout_methods = $payment_modules->checkout_initialization_method();

        if (!empty($initialize_checkout_methods)) {
            $output = '<p align="right" style="clear: both; padding: 15px 50px 0 0;">'.TEXT_ALTERNATIVE_CHECKOUT_METHODS.'</p>';

            foreach ($initialize_checkout_methods as $value) {
                $output .= '<p align="right">'.$value.'</p>';
            }

            return $output;
        }
    }
}
