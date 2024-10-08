<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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
 * Braintree AmexExpressCheckoutCard module
 * Creates and manages Braintree Amex Express Checkout cards.
 *
 * <b>== More information ==</b>
 *
 * See {@link https://developers.braintreepayments.com/javascript+php}<br />
 *
 * @category   Resources
 *
 * @property string                    $bin
 * @property string                    $cardMemberExpiryDate
 * @property string                    $cardMemberNumber
 * @property string                    $cardType
 * @property \DateTime                 $createdAt
 * @property string                    $customerId
 * @property bool                      $default
 * @property string                    $expirationMonth
 * @property string                    $expirationYear
 * @property string                    $imageUrl
 * @property string                    $sourceDescription
 * @property \Braintree\Subscription[] $subscriptions
 * @property string                    $token
 * @property \DateTime                 $updatedAt
 *
 * @deprecated
 */
class AmexExpressCheckoutCard extends Base
{
    /* instance methods */
    /**
     * returns false if default is null or false.
     *
     * @deprecated
     *
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     *  factory method: returns an instance of AmexExpressCheckoutCard
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @deprecated
     *
     * @param mixed $attributes
     *
     * @return AmexExpressCheckoutCard
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
     * @deprecated
     *
     * @param array $amexExpressCheckoutCardAttribs array of Amex Express Checkout card properties
     */
    protected function _initialize($amexExpressCheckoutCardAttribs): void
    {
        // set the attributes
        $this->_attributes = $amexExpressCheckoutCardAttribs;

        $subscriptionArray = [];

        if (isset($amexExpressCheckoutCardAttribs['subscriptions'])) {
            foreach ($amexExpressCheckoutCardAttribs['subscriptions'] as $subscription) {
                $subscriptionArray[] = Subscription::factory($subscription);
            }
        }

        $this->_set('subscriptions', $subscriptionArray);
    }
}
