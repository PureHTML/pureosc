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
 * Braintree PayPalAccount module.
 *
 * @category   Resources
 */

/**
 * Manages Braintree PayPalAccounts.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 *
 * @property string                    $billingAgreementId
 * @property \DateTime                 $createdAt
 * @property string                    $customerId
 * @property bool                      $default
 * @property string                    $email
 * @property string                    $imageUrl
 * @property string                    $payerId
 * @property \DateTime                 $revokedAt
 * @property \Braintree\Subscription[] $subscriptions
 * @property string                    $token
 * @property \DateTime                 $updatedAt
 */
class PayPalAccount extends Base
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
     *  factory method: returns an instance of PayPalAccount
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return PayPalAccount
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    /* instance methods */

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
        return Configuration::gateway()->payPalAccount()->find($token);
    }

    public static function update($token, $attributes)
    {
        return Configuration::gateway()->payPalAccount()->update($token, $attributes);
    }

    public static function delete($token)
    {
        return Configuration::gateway()->payPalAccount()->delete($token);
    }

    public static function sale($token, $transactionAttribs)
    {
        return Configuration::gateway()->payPalAccount()->sale($token, $transactionAttribs);
    }

    /**
     * sets instance properties from an array of values.
     *
     * @param array $paypalAccountAttribs array of paypalAccount data
     */
    protected function _initialize($paypalAccountAttribs): void
    {
        // set the attributes
        $this->_attributes = $paypalAccountAttribs;

        $subscriptionArray = [];

        if (isset($paypalAccountAttribs['subscriptions'])) {
            foreach ($paypalAccountAttribs['subscriptions'] as $subscription) {
                $subscriptionArray[] = Subscription::factory($subscription);
            }
        }

        $this->_set('subscriptions', $subscriptionArray);
    }
}
