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

namespace Braintree\Test;

/**
 * VenmoSdk payment method codes used for testing purposes.
 */
class VenmoSdk
{
    public static $visaPaymentMethodCode = 'stub-4111111111111111';

    public static function generateTestPaymentMethodCode($number)
    {
        return 'stub-'.$number;
    }

    public static function getInvalidPaymentMethodCode()
    {
        return 'stub-invalid-payment-method-code';
    }

    public static function getTestSession()
    {
        return 'stub-session';
    }

    public static function getInvalidTestSession()
    {
        return 'stub-invalid-session';
    }
}
