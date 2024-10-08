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
 * Braintree VisaCheckoutCard module
 * Creates and manages Braintree VisaCheckoutCards.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on CreditCard verifications, see {@link https://developers.braintreepayments.com/reference/response/credit-card-verification/php https://developers.braintreepayments.com/reference/response/credit-card-verification/php}
 *
 * @category   Resources
 *
 * @property \Braintree\Address        $billingAddress
 * @property string                    $bin
 * @property string                    $callId
 * @property string                    $cardholderName
 * @property string                    $cardType
 * @property string                    $commercial
 * @property string                    $countryOfIssuance
 * @property \DateTime                 $createdAt
 * @property string                    $customerId
 * @property string                    $customerLocation
 * @property string                    $debit
 * @property bool                      $default
 * @property string                    $durbinRegulated
 * @property string                    $expirationDate
 * @property string                    $expirationMonth
 * @property string                    $expirationYear
 * @property bool                      $expired
 * @property string                    $healthcare
 * @property string                    $imageUrl
 * @property string                    $issuingBank
 * @property string                    $last4
 * @property string                    $maskedNumber
 * @property string                    $payroll
 * @property string                    $prepaid
 * @property string                    $productId
 * @property \Braintree\Subscription[] $subscriptions
 * @property string                    $token
 * @property string                    $uniqueNumberIdentifier
 * @property \DateTime                 $updatedAt
 */
class VisaCheckoutCard extends Base
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
     * returns false if comparing object is not a VisaCheckoutCard,
     * or is a VisaCheckoutCard with a different id.
     *
     * @param object $otherVisaCheckoutCard customer to compare against
     *
     * @return bool
     */
    public function isEqual($otherVisaCheckoutCard)
    {
        return !($otherVisaCheckoutCard instanceof self) ? false : $this->token === $otherVisaCheckoutCard->token;
    }

    /**
     *  factory method: returns an instance of VisaCheckoutCard
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return VisaCheckoutCard
     */
    public static function factory($attributes)
    {
        $defaultAttributes = [
            'bin' => '',
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
     * @param array $creditCardAttribs array of creditcard data
     */
    protected function _initialize($creditCardAttribs): void
    {
        // set the attributes
        $this->_attributes = $creditCardAttribs;

        // map each address into its own object
        $billingAddress = isset($creditCardAttribs['billingAddress']) ?
            Address::factory($creditCardAttribs['billingAddress']) :
            null;

        $subscriptionArray = [];

        if (isset($creditCardAttribs['subscriptions'])) {
            foreach ($creditCardAttribs['subscriptions'] as $subscription) {
                $subscriptionArray[] = Subscription::factory($subscription);
            }
        }

        $this->_set('subscriptions', $subscriptionArray);
        $this->_set('billingAddress', $billingAddress);
        $this->_set('expirationDate', $this->expirationMonth.'/'.$this->expirationYear);
        $this->_set('maskedNumber', $this->bin.'******'.$this->last4);

        if (isset($creditCardAttribs['verifications']) && \count($creditCardAttribs['verifications']) > 0) {
            $verifications = $creditCardAttribs['verifications'];
            usort($verifications, [$this, '_compareCreatedAtOnVerifications']);

            $this->_set('verification', CreditCardVerification::factory($verifications[0]));
        }
    }

    private function _compareCreatedAtOnVerifications($verificationAttrib1, $verificationAttrib2)
    {
        return ($verificationAttrib2['createdAt'] < $verificationAttrib1['createdAt']) ? -1 : 1;
    }
}
