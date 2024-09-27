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
 * Braintree UsBankAccount module.
 *
 * @category   Resources
 */

/**
 * Manages Braintree UsBankAccounts.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 *
 * @property string $accountHolderName
 * @property string $accountType
 * @property string $achMandate
 * @property string $bankName
 * @property string $customerId
 * @property bool   $default
 * @property string $email
 * @property string $imageUrl
 * @property string $last4
 * @property string $routingNumber
 * @property string $token
 * @property bool   $verified
 */
class UsBankAccount extends Base
{
    /**
     * create a printable representation of the object as:
     * ClassName[property=value, property=value]
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__.'['.
                Util::attributesToString($this->_attributes).']';
    }
    /**
     *  factory method: returns an instance of UsBankAccount
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return UsBankAccount
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    /**
     * returns false if default is null or false.
     *
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }

    // static methods redirecting to gateway

    public static function find($token)
    {
        return Configuration::gateway()->usBankAccount()->find($token);
    }

    public static function sale($token, $transactionAttribs)
    {
        $transactionAttribs['options'] = [
            'submitForSettlement' => true,
        ];

        return Configuration::gateway()->usBankAccount()->sale($token, $transactionAttribs);
    }

    /* instance methods */

    /**
     * sets instance properties from an array of values.
     *
     * @param array $usBankAccountAttribs array of usBankAccount data
     */
    protected function _initialize($usBankAccountAttribs): void
    {
        // set the attributes
        $this->_attributes = $usBankAccountAttribs;

        $achMandate = isset($usBankAccountAttribs['achMandate']) ?
            AchMandate::factory($usBankAccountAttribs['achMandate']) :
            null;
        $this->_set('achMandate', $achMandate);

        if (isset($usBankAccountAttribs['verifications'])) {
            $verification_records = $usBankAccountAttribs['verifications'];

            $verifications = [];

            for ($i = 0; $i < \count($verification_records); ++$i) {
                $verifications[$i] = UsBankAccountVerification::factory($verification_records[$i]);
            }

            $this->_set('verifications', $verifications);
        } else {
            $this->_set('verifications', null);
        }
    }
}
