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

class CreditCardVerificationSearch
{
    public static function id()
    {
        return new TextNode('id');
    }

    public static function creditCardCardholderName()
    {
        return new TextNode('credit_card_cardholder_name');
    }

    public static function billingAddressDetailsPostalCode()
    {
        return new TextNode('billing_address_details_postal_code');
    }

    public static function customerEmail()
    {
        return new TextNode('customer_email');
    }

    public static function customerId()
    {
        return new TextNode('customer_id');
    }

    public static function paymentMethodToken()
    {
        return new TextNode('payment_method_token');
    }

    public static function creditCardExpirationDate()
    {
        return new EqualityNode('credit_card_expiration_date');
    }

    public static function creditCardNumber()
    {
        return new PartialMatchNode('credit_card_number');
    }

    public static function ids()
    {
        return new MultipleValueNode('ids');
    }

    public static function createdAt()
    {
        return new RangeNode('created_at');
    }

    public static function creditCardCardType()
    {
        return new MultipleValueNode('credit_card_card_type', CreditCard::allCardTypes());
    }

    public static function status()
    {
        return new MultipleValueNode('status', Result\CreditCardVerification::allStatuses());
    }
}
