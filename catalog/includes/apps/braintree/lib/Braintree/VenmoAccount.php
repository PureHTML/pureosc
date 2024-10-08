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
 * Braintree VenmoAccount module
 * Creates and manages Braintree Venmo accounts.
 *
 * <b>== More information ==</b>
 *
 * See {@link https://developers.braintreepayments.com/javascript+php}<br />
 *
 * @category   Resources
 *
 * @property \DateTime                 $createdAt
 * @property string                    $customerId
 * @property bool                      $default
 * @property string                    $imageUrl
 * @property string                    $sourceDescription
 * @property \Braintree\Subscription[] $subscriptions
 * @property string                    $token
 * @property \DateTime                 $updatedAt
 * @property string                    $username
 * @property string                    $venmoUserId
 */
class VenmoAccount extends Base
{
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

    /**
     *  factory method: returns an instance of VenmoAccount
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return VenmoAccount
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    /**
     * sets instance properties from an array of values.
     *
     * @param array $venmoAccountAttribs array of Venmo account properties
     */
    protected function _initialize($venmoAccountAttribs): void
    {
        $this->_attributes = $venmoAccountAttribs;

        $subscriptionArray = [];

        if (isset($venmoAccountAttribs['subscriptions'])) {
            foreach ($venmoAccountAttribs['subscriptions'] as $subscription) {
                $subscriptionArray[] = Subscription::factory($subscription);
            }
        }

        $this->_set('subscriptions', $subscriptionArray);
    }
}
