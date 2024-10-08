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
 * Braintree CreditCard module
 * Creates and manages Braintree CreditCards.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on CreditCards, see {@link https://developers.braintreepayments.com/reference/response/credit-card/php https://developers.braintreepayments.com/reference/response/credit-card/php}<br />
 * For more detailed information on CreditCard verifications, see {@link https://developers.braintreepayments.com/reference/response/credit-card-verification/php https://developers.braintreepayments.com/reference/response/credit-card-verification/php}
 *
 * @category   Resources
 *
 * @property \Braintree\Address                     $billingAddress
 * @property string                                 $bin
 * @property string                                 $cardholderName
 * @property string                                 $cardType
 * @property string                                 $commercial
 * @property string                                 $countryOfIssuance
 * @property \DateTime                              $createdAt
 * @property string                                 $customerId
 * @property string                                 $customerLocation
 * @property string                                 $debit
 * @property bool                                   $default
 * @property string                                 $durbinRegulated
 * @property string                                 $expirationDate
 * @property string                                 $expirationMonth
 * @property string                                 $expirationYear
 * @property bool                                   $expired
 * @property bool                                   $healthcare
 * @property string                                 $imageUrl
 * @property string                                 $isNetworkTokenized
 * @property string                                 $issuingBank
 * @property string                                 $last4
 * @property string                                 $maskedNumber
 * @property string                                 $payroll
 * @property string                                 $prepaid
 * @property string                                 $productId
 * @property \Braintree\Subscription[]              $subscriptions
 * @property string                                 $token
 * @property string                                 $uniqueNumberIdentifier
 * @property \DateTime                              $updatedAt
 * @property null|\Braintree\CreditCardVerification $verification
 */
class CreditCard extends Base
{
    // Card Type
    public const AMEX = 'American Express';
    public const CARTE_BLANCHE = 'Carte Blanche';
    public const CHINA_UNION_PAY = 'China UnionPay';
    public const DINERS_CLUB_INTERNATIONAL = 'Diners Club';
    public const DISCOVER = 'Discover';
    public const ELO = 'Elo';
    public const JCB = 'JCB';
    public const LASER = 'Laser';
    public const MAESTRO = 'Maestro';
    public const UK_MAESTRO = 'UK Maestro';
    public const MASTER_CARD = 'MasterCard';
    public const SOLO = 'Solo';
    public const SWITCH_TYPE = 'Switch';
    public const VISA = 'Visa';
    public const UNKNOWN = 'Unknown';

    // Credit card origination location
    public const INTERNATIONAL = 'international';
    public const US = 'us';
    public const PREPAID_YES = 'Yes';
    public const PREPAID_NO = 'No';
    public const PREPAID_UNKNOWN = 'Unknown';
    public const PAYROLL_YES = 'Yes';
    public const PAYROLL_NO = 'No';
    public const PAYROLL_UNKNOWN = 'Unknown';
    public const HEALTHCARE_YES = 'Yes';
    public const HEALTHCARE_NO = 'No';
    public const HEALTHCARE_UNKNOWN = 'Unknown';
    public const DURBIN_REGULATED_YES = 'Yes';
    public const DURBIN_REGULATED_NO = 'No';
    public const DURBIN_REGULATED_UNKNOWN = 'Unknown';
    public const DEBIT_YES = 'Yes';
    public const DEBIT_NO = 'No';
    public const DEBIT_UNKNOWN = 'Unknown';
    public const COMMERCIAL_YES = 'Yes';
    public const COMMERCIAL_NO = 'No';
    public const COMMERCIAL_UNKNOWN = 'Unknown';
    public const COUNTRY_OF_ISSUANCE_UNKNOWN = 'Unknown';
    public const ISSUING_BANK_UNKNOWN = 'Unknown';
    public const PRODUCT_ID_UNKNOWN = 'Unknown';

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
     * checks whether the card is associated with venmo sdk.
     *
     * @return bool
     */
    public function isVenmoSdk()
    {
        return $this->venmoSdk;
    }

    /**
     * returns false if comparing object is not a CreditCard,
     * or is a CreditCard with a different id.
     *
     * @param object $otherCreditCard customer to compare against
     *
     * @return bool
     */
    public function isEqual($otherCreditCard)
    {
        return !($otherCreditCard instanceof self) ? false : $this->token === $otherCreditCard->token;
    }

    /**
     *  factory method: returns an instance of CreditCard
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return CreditCard
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

    // static methods redirecting to gateway

    public static function create($attribs)
    {
        return Configuration::gateway()->creditCard()->create($attribs);
    }

    public static function createNoValidate($attribs)
    {
        return Configuration::gateway()->creditCard()->createNoValidate($attribs);
    }

    public static function createCreditCardUrl()
    {
        return Configuration::gateway()->creditCard()->createCreditCardUrl();
    }

    public static function expired()
    {
        return Configuration::gateway()->creditCard()->expired();
    }

    public static function fetchExpired($ids)
    {
        return Configuration::gateway()->creditCard()->fetchExpired($ids);
    }

    public static function expiringBetween($startDate, $endDate)
    {
        return Configuration::gateway()->creditCard()->expiringBetween($startDate, $endDate);
    }

    public static function fetchExpiring($startDate, $endDate, $ids)
    {
        return Configuration::gateway()->creditCard()->fetchExpiring($startDate, $endDate, $ids);
    }

    public static function find($token)
    {
        return Configuration::gateway()->creditCard()->find($token);
    }

    public static function fromNonce($nonce)
    {
        return Configuration::gateway()->creditCard()->fromNonce($nonce);
    }

    public static function credit($token, $transactionAttribs)
    {
        return Configuration::gateway()->creditCard()->credit($token, $transactionAttribs);
    }

    public static function creditNoValidate($token, $transactionAttribs)
    {
        return Configuration::gateway()->creditCard()->creditNoValidate($token, $transactionAttribs);
    }

    public static function sale($token, $transactionAttribs)
    {
        return Configuration::gateway()->creditCard()->sale($token, $transactionAttribs);
    }

    public static function saleNoValidate($token, $transactionAttribs)
    {
        return Configuration::gateway()->creditCard()->saleNoValidate($token, $transactionAttribs);
    }

    public static function update($token, $attributes)
    {
        return Configuration::gateway()->creditCard()->update($token, $attributes);
    }

    public static function updateNoValidate($token, $attributes)
    {
        return Configuration::gateway()->creditCard()->updateNoValidate($token, $attributes);
    }

    public static function updateCreditCardUrl()
    {
        return Configuration::gateway()->creditCard()->updateCreditCardUrl();
    }

    public static function delete($token)
    {
        return Configuration::gateway()->creditCard()->delete($token);
    }

    /**
     * @return array
     */
    public static function allCardTypes()
    {
        return [
            self::AMEX,
            self::CARTE_BLANCHE,
            self::CHINA_UNION_PAY,
            self::DINERS_CLUB_INTERNATIONAL,
            self::DISCOVER,
            self::ELO,
            self::JCB,
            self::LASER,
            self::MAESTRO,
            self::MASTER_CARD,
            self::SOLO,
            self::SWITCH_TYPE,
            self::VISA,
            self::UNKNOWN,
        ];
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
