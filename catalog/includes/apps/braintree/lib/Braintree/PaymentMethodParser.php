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

namespace Braintree;

/**
 * Braintree PaymentMethodParser module.
 *
 * @category   Resources
 */

/**
 * Manages Braintree PaymentMethodParser.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 */
class PaymentMethodParser
{
    public static function parsePaymentMethod($response)
    {
        if (isset($response['creditCard'])) {
            return CreditCard::factory($response['creditCard']);
        }

        if (isset($response['paypalAccount'])) {
            return PayPalAccount::factory($response['paypalAccount']);
        }

        if (isset($response['applePayCard'])) {
            return ApplePayCard::factory($response['applePayCard']);
        }

        if (isset($response['androidPayCard'])) {
            return AndroidPayCard::factory($response['androidPayCard']);
        }

        if (isset($response['amexExpressCheckoutCard'])) {
            // NEXT_MAJOR_VERSION remove deprecated amexExpressCheckoutCard
            return AmexExpressCheckoutCard::factory($response['amexExpressCheckoutCard']);
        }

        if (isset($response['usBankAccount'])) {
            return UsBankAccount::factory($response['usBankAccount']);
        }

        if (isset($response['venmoAccount'])) {
            return VenmoAccount::factory($response['venmoAccount']);
        }

        if (isset($response['visaCheckoutCard'])) {
            return VisaCheckoutCard::factory($response['visaCheckoutCard']);
            // NEXT_MAJOR_VERSION remove deprecated masterpassCard
        }

        if (isset($response['masterpassCard'])) {
            return MasterpassCard::factory($response['masterpassCard']);
        }

        if (isset($response['samsungPayCard'])) {
            return SamsungPayCard::factory($response['samsungPayCard']);
        }

        if (\is_array($response)) {
            return UnknownPaymentMethod::factory($response);
        }

        throw new Exception\Unexpected(
            'Expected payment method',
        );
    }
}
