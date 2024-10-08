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

namespace Braintree\Result;

use Braintree\Base;
use Braintree\RiskData;
use Braintree\ThreeDSecureInfo;
use Braintree\Util;

/**
 * Braintree Credit Card Verification Result.
 *
 * This object is returned as part of an Error Result; it provides
 * access to the credit card verification data from the gateway
 *
 * @property null|string $avsErrorResponseCode
 * @property string      $avsPostalCodeResponseCode
 * @property string      $avsStreetAddressResponseCode
 * @property string      $cvvResponseCode
 * @property string      $status
 */
class CreditCardVerification extends Base
{
    // Status
    public const FAILED = 'failed';
    public const GATEWAY_REJECTED = 'gateway_rejected';
    public const PROCESSOR_DECLINED = 'processor_declined';
    public const VERIFIED = 'verified';
    private $_amount;
    private $_avsErrorResponseCode;
    private $_avsPostalCodeResponseCode;
    private $_avsStreetAddressResponseCode;
    private $_currencyIsoCode;
    private $_cvvResponseCode;
    private $_gatewayRejectionReason;
    private $_status;

    /**
     * @ignore
     *
     * @param mixed $attributes
     */
    public function __construct($attributes)
    {
        $this->_initializeFromArray($attributes);
    }

    /**
     * @ignore
     *
     * @param mixed $name
     */
    public function __get($name)
    {
        $varName = "_{$name}";

        return $this->{$varName} ?? null;
    }

    /**
     * returns a string representation of the customer.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__.'['.
                Util::attributesToString($this->_attributes).']';
    }

    public static function allStatuses()
    {
        return [
            self::FAILED,
            self::GATEWAY_REJECTED,
            self::PROCESSOR_DECLINED,
            self::VERIFIED,
        ];
    }

    /**
     * initializes instance properties from the keys/values of an array.
     *
     * @ignore
     *
     * @param mixed $attributes
     * @param <type> $aAttribs array of properties to set - single level
     */
    private function _initializeFromArray($attributes): void
    {
        if (isset($attributes['riskData'])) {
            $attributes['riskData'] = RiskData::factory($attributes['riskData']);
        }

        if (isset($attributes['globalId'])) {
            $attributes['graphQLId'] = $attributes['globalId'];
        }

        if (isset($attributes['threeDSecureInfo'])) {
            $attributes['threeDSecureInfo'] = ThreeDSecureInfo::factory($attributes['threeDSecureInfo']);
        }

        $this->_attributes = $attributes;

        foreach ($attributes as $name => $value) {
            $varName = "_{$name}";
            $this->{$varName} = $value;
        }
    }
}
