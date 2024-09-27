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
