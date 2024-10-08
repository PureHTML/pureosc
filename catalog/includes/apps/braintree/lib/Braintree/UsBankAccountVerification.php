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
 * Braintree UsBankAccountVerification module.
 *
 * @category   Resources
 */

/**
 * Manages Braintree UsBankAccountVerifications.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 */
class UsBankAccountVerification extends Result\UsBankAccountVerification
{
    /**
     * create a printable representation of the object as:
     * ClassName[property=value, property=value]
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__.'['.Util::attributesToString($this->_attributes).']';
    }
    /**
     *  factory method: returns an instance of UsBankAccountVerification
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return UsBankAccountVerification
     */
    public static function factory($attributes)
    {
        $instance = new self($attributes);
        $instance->_initialize($attributes);

        return $instance;
    }

    // static methods redirecting to gateway

    /**
     * finds a US bank account verification.
     *
     * @param string $token unique id
     *
     * @return UsBankAccountVerification
     */
    public static function find($token)
    {
        return Configuration::gateway()->usBankAccountVerification()->find($token);
    }

    /**
     * Returns a ResourceCollection of US bank account verifications matching the search query.
     *
     * @param mixed $query search query
     *
     * @return ResourceCollection
     */
    public static function search($query)
    {
        return Configuration::gateway()->usBankAccountVerification()->search($query);
    }

    /**
     * Returns a ResourceCollection of US bank account verifications matching the search query.
     *
     * @param string $token   unique id
     * @param array  $amounts micro transfer amounts
     *
     * @return ResourceCollection
     */
    public static function confirmMicroTransferAmounts($token, $amounts)
    {
        return Configuration::gateway()->usBankAccountVerification()->confirmMicroTransferAmounts($token, $amounts);
    }

    /* instance methods */

    /**
     * sets instance properties from an array of values.
     *
     * @param array $usBankAccountVerificationAttribs array of usBankAccountVerification data
     */
    protected function _initialize($usBankAccountVerificationAttribs): void
    {
        // set the attributes
        $this->_attributes = $usBankAccountVerificationAttribs;
    }
}
