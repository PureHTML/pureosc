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
 * {@inheritDoc}
 *
 * @property string                           $amount
 * @property mixed                            $billing
 * @property string                           $company
 * @property string                           $countryName
 * @property \DateTime                        $createdAt
 * @property \Braintree\CreditCard            $creditCard
 * @property string                           $extendedAddress
 * @property string                           $firstName
 * @property null|string                      $gatewayRejectionReason
 * @property string                           $graphQLId
 * @property string                           $id
 * @property string                           $lastName
 * @property string                           $locality
 * @property string                           $merchantAccountId
 * @property string                           $networkTransactionId
 * @property string                           $postalCode
 * @property string                           $processorResponseCode
 * @property string                           $processorResponseText
 * @property string                           $processorResponseType
 * @property string                           $region
 * @property null|\Braintree\RiskData         $riskData
 * @property string                           $streetAddress
 * @property null|\Braintree\ThreeDSecureInfo $threeDSecureInfo
 */
class CreditCardVerification extends Result\CreditCardVerification
{
    public static function factory($attributes)
    {
        return new self($attributes);
    }

    // static methods redirecting to gateway
    //
    public static function create($attributes)
    {
        Util::verifyKeys(self::createSignature(), $attributes);

        return Configuration::gateway()->creditCardVerification()->create($attributes);
    }

    public static function fetch($query, $ids)
    {
        return Configuration::gateway()->creditCardVerification()->fetch($query, $ids);
    }

    public static function search($query)
    {
        return Configuration::gateway()->creditCardVerification()->search($query);
    }

    public static function createSignature()
    {
        return [
            ['options' => ['amount', 'merchantAccountId', 'accountType']],
            ['creditCard' => [
                'cardholderName', 'cvv', 'number',
                'expirationDate', 'expirationMonth', 'expirationYear',
                ['billingAddress' => CreditCardGateway::billingAddressSignature()],
            ],
            ]];
    }
}
