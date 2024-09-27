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

namespace Braintree\Result;

use Braintree\Base;
use Braintree\UsBankAccount;
use Braintree\Util;

/**
 * Braintree US Bank Account Verification Result.
 *
 * This object is returned as part of an Error Result; it provides
 * access to the credit card verification data from the gateway
 *
 * @property string                  $id
 * @property string                  $status
 * @property Braintree\UsBankAccount $usBankAccount
 * @property \DateTime               $verificationDeterminedAt
 * @property string                  $verificationMethod
 */
class UsBankAccountVerification extends Base
{
    // Status
    public const FAILED = 'failed';
    public const GATEWAY_REJECTED = 'gateway_rejected';
    public const PROCESSOR_DECLINED = 'processor_declined';
    public const VERIFIED = 'verified';
    public const PENDING = 'pending';
    public const TOKENIZED_CHECK = 'tokenized_check';
    public const NETWORK_CHECK = 'network_check';
    public const INDEPENDENT_CHECK = 'independent_check';
    public const MICRO_TRANSFERS = 'micro_transfers';
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

        $usBankAccount = isset($attributes['usBankAccount']) ?
            UsBankAccount::factory($attributes['usBankAccount']) :
            null;
        $this->usBankAccount = $usBankAccount;
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
            self::PENDING,
        ];
    }

    public static function allVerificationMethods()
    {
        return [
            self::TOKENIZED_CHECK,
            self::NETWORK_CHECK,
            self::INDEPENDENT_CHECK,
            self::MICRO_TRANSFERS,
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
        $this->_attributes = $attributes;

        foreach ($attributes as $name => $value) {
            $varName = "_{$name}";
            $this->{$varName} = $value;
        }
    }
}
