<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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

class PaymentInstrumentType
{
    public const ANDROID_PAY_CARD = 'android_pay_card'; // NEXT_MAJOR_VERSION rename Android Pay to Google Pay
    public const APPLE_PAY_CARD = 'apple_pay_card';
    public const CREDIT_CARD = 'credit_card';
    public const LOCAL_PAYMENT = 'local_payment';
    public const MASTERPASS_CARD = 'masterpass_card'; // NEXT_MAJOR_VERSION remove this deprecated constant
    public const PAYPAL_ACCOUNT = 'paypal_account';
    public const PAYPAL_HERE = 'paypal_here';
    public const SAMSUNG_PAY_CARD = 'samsung_pay_card';
    public const US_BANK_ACCOUNT = 'us_bank_account';
    public const VENMO_ACCOUNT = 'venmo_account';
    public const VISA_CHECKOUT_CARD = 'visa_checkout_card';
}
