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

// NEXT_MAJOR_VERSION rename to GooglePayCard

/**
 * Braintree AndroidPayCard module
 * Creates and manages Braintree Android Pay cards.
 *
 * <b>== More information ==</b>
 *
 * See {@link https://developers.braintreepayments.com/javascript+php}<br />
 *
 * @category   Resources
 *
 * @property string                    $bin
 * @property string                    $cardType
 * @property \DateTime                 $createdAt
 * @property string                    $customerId
 * @property bool                      $default
 * @property string                    $expirationMonth
 * @property string                    $expirationYear
 * @property string                    $googleTransactionId
 * @property string                    $imageUrl
 * @property bool                      $isNetworkTokenized
 * @property string                    $last4
 * @property string                    $sourceCardLast4
 * @property string                    $sourceCardType
 * @property string                    $sourceDescription
 * @property \Braintree\Subscription[] $subscriptions
 * @property string                    $token
 * @property \DateTime                 $updatedAt
 * @property string                    $virtualCardLast4
 * @property string                    $virtualCardType
 */
class AndroidPayCard extends Base
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
     *  factory method: returns an instance of AndroidPayCard
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return AndroidPayCard
     */
    public static function factory($attributes)
    {
        $defaultAttributes = [
            'expirationMonth' => '',
            'expirationYear' => '',
            'last4' => $attributes['virtualCardLast4'],
            'cardType' => $attributes['virtualCardType'],
        ];

        $instance = new self();
        $instance->_initialize(array_merge($defaultAttributes, $attributes));

        return $instance;
    }

    /**
     * sets instance properties from an array of values.
     *
     * @param array $androidPayCardAttribs array of Android Pay card properties
     */
    protected function _initialize($androidPayCardAttribs): void
    {
        // set the attributes
        $this->_attributes = $androidPayCardAttribs;

        $subscriptionArray = [];

        if (isset($androidPayCardAttribs['subscriptions'])) {
            foreach ($androidPayCardAttribs['subscriptions'] as $subscription) {
                $subscriptionArray[] = Subscription::factory($subscription);
            }
        }

        $this->_set('subscriptions', $subscriptionArray);
    }
}
