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
 * Braintree ApplePayCard module
 * Creates and manages Braintree Apple Pay cards.
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
 * @property string                    $expirationDate
 * @property string                    $expirationMonth
 * @property string                    $expirationYear
 * @property bool                      $expired
 * @property string                    $imageUrl
 * @property string                    $last4
 * @property string                    $paymentInstrumentName
 * @property string                    $sourceDescription
 * @property \Braintree\Subscription[] $subscriptions
 * @property string                    $token
 * @property \DateTime                 $updatedAt
 */
class ApplePayCard extends Base
{
    // Card Type
    public const AMEX = 'Apple Pay - American Express';
    public const MASTER_CARD = 'Apple Pay - MasterCard';
    public const VISA = 'Apple Pay - Visa';

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
     * checks whether the card is expired based on the current date.
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->expired;
    }

    /**
     *  factory method: returns an instance of ApplePayCard
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return ApplePayCard
     */
    public static function factory($attributes)
    {
        $defaultAttributes = [
            'expirationMonth' => '',
            'expirationYear' => '',
            'last4' => '',
        ];

        $instance = new self();
        $instance->_initialize(array_merge($defaultAttributes, $attributes));

        return $instance;
    }

    /**
     * sets instance properties from an array of values.
     *
     * @param array $applePayCardAttribs array of Apple Pay card properties
     */
    protected function _initialize($applePayCardAttribs): void
    {
        // set the attributes
        $this->_attributes = $applePayCardAttribs;

        $subscriptionArray = [];

        if (isset($applePayCardAttribs['subscriptions'])) {
            foreach ($applePayCardAttribs['subscriptions'] as $subscription) {
                $subscriptionArray[] = Subscription::factory($subscription);
            }
        }

        $this->_set('subscriptions', $subscriptionArray);
        $this->_set('expirationDate', $this->expirationMonth.'/'.$this->expirationYear);
    }
}
