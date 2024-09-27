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

/**
 * @property \Braintree\MerchantAccount\BusinessDetails   $businessDetails
 * @property string                                       $currencyIsoCode
 * @property bool                                         $default
 * @property \Braintree\MerchantAccount\FundingDetails    $fundingDetails
 * @property string                                       $id
 * @property \Braintree\MerchantAccount\IndividualDetails $individualDetails
 * @property \Braintree\MerchantAccount                   $masterMerchantAccount
 * @property string                                       $status
 */
class MerchantAccount extends Base
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_PENDING = 'pending';
    public const STATUS_SUSPENDED = 'suspended';
    public const FUNDING_DESTINATION_BANK = 'bank';
    public const FUNDING_DESTINATION_EMAIL = 'email';
    public const FUNDING_DESTINATION_MOBILE_PHONE = 'mobile_phone';

    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    // static methods redirecting to gateway

    public static function create($attribs)
    {
        return Configuration::gateway()->merchantAccount()->create($attribs);
    }

    public static function find($merchant_account_id)
    {
        return Configuration::gateway()->merchantAccount()->find($merchant_account_id);
    }

    public static function update($merchant_account_id, $attributes)
    {
        return Configuration::gateway()->merchantAccount()->update($merchant_account_id, $attributes);
    }

    protected function _initialize($merchantAccountAttribs): void
    {
        $this->_attributes = $merchantAccountAttribs;

        if (isset($merchantAccountAttribs['individual'])) {
            $individual = $merchantAccountAttribs['individual'];
            $this->_set('individualDetails', MerchantAccount\IndividualDetails::Factory($individual));
        }

        if (isset($merchantAccountAttribs['business'])) {
            $business = $merchantAccountAttribs['business'];
            $this->_set('businessDetails', MerchantAccount\BusinessDetails::Factory($business));
        }

        if (isset($merchantAccountAttribs['funding'])) {
            $funding = $merchantAccountAttribs['funding'];
            $this->_set('fundingDetails', new MerchantAccount\FundingDetails($funding));
        }

        if (isset($merchantAccountAttribs['masterMerchantAccount'])) {
            $masterMerchantAccount = $merchantAccountAttribs['masterMerchantAccount'];
            $this->_set('masterMerchantAccount', self::Factory($masterMerchantAccount));
        }
    }
}
