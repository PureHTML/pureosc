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
 * Braintree MasterpassCard module
 * Creates and manages Braintree MasterpassCards.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on CreditCard verifications, see {@link https://developers.braintreepayments.com/reference/response/credit-card-verification/php https://developers.braintreepayments.com/reference/response/credit-card-verification/php}
 *
 * @category   Resources
 *
 * @property \Braintree\Address        $billingAddress
 * @property string                    $bin
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
class MasterpassCard extends Base
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
     * returns false if comparing object is not a CreditCard,
     * or is a CreditCard with a different id.
     *
     * @param mixed $otherMasterpassCard
     *
     * @return bool
     */
    public function isEqual($otherMasterpassCard)
    {
        return !($otherMasterpassCard instanceof self) ? false : $this->token === $otherMasterpassCard->token;
    }

    /**
     *  factory method: returns an instance of CreditCard
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return MasterpassCard
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
    }
}
