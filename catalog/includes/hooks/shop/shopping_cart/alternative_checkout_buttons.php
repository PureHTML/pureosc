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

/**
 * This file is part of the DvereCOM package.
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class alternative_checkout_buttons
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
