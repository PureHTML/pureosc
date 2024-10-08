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
 * Braintree Transaction processor
 * Creates and manages transactions.
 *
 * At minimum, an amount, credit card number, and
 * credit card expiration date are required.
 *
 * <b>Minimalistic example:</b>
 * <code>
 * Transaction::saleNoValidate(array(
 *   'amount' => '100.00',
 *   'creditCard' => array(
 *       'number' => '5105105105105100',
 *       'expirationDate' => '05/12',
 *       ),
 *   ));
 * </code>
 *
 * <b>Full example:</b>
 * <code>
 * Transaction::saleNoValidate(array(
 *    'amount'      => '100.00',
 *    'orderId'    => '123',
 *    'channel'    => 'MyShoppingCardProvider',
 *    'creditCard' => array(
 *         // if token is omitted, the gateway will generate a token
 *         'token' => 'credit_card_123',
 *         'number' => '5105105105105100',
 *         'expirationDate' => '05/2011',
 *         'cvv' => '123',
 *    ),
 *    'customer' => array(
 *     // if id is omitted, the gateway will generate an id
 *     'id'    => 'customer_123',
 *     'firstName' => 'Dan',
 *     'lastName' => 'Smith',
 *     'company' => 'Braintree',
 *     'email' => 'dan@example.com',
 *     'phone' => '419-555-1234',
 *     'fax' => '419-555-1235',
 *     'website' => 'http://braintreepayments.com'
 *    ),
 *    'billing'    => array(
 *      'firstName' => 'Carl',
 *      'lastName'  => 'Jones',
 *      'company'    => 'Braintree',
 *      'streetAddress' => '123 E Main St',
 *      'extendedAddress' => 'Suite 403',
 *      'locality' => 'Chicago',
 *      'region' => 'IL',
 *      'postalCode' => '60622',
 *      'countryName' => 'United States of America'
 *    ),
 *    'shipping' => array(
 *      'firstName'    => 'Andrew',
 *      'lastName'    => 'Mason',
 *      'company'    => 'Braintree',
 *      'streetAddress'    => '456 W Main St',
 *      'extendedAddress'    => 'Apt 2F',
 *      'locality'    => 'Bartlett',
 *      'region'    => 'IL',
 *      'postalCode'    => '60103',
 *      'countryName'    => 'United States of America'
 *    ),
 *    'customFields'    => array(
 *      'birthdate'    => '11/13/1954'
 *    )
 *  )
 * </code>
 *
 * <b>== Storing in the Vault ==</b>
 *
 * The customer and credit card information used for
 * a transaction can be stored in the vault by setting
 * <i>transaction[options][storeInVault]</i> to true.
 * <code>
 *   $transaction = Transaction::saleNoValidate(array(
 *     'customer' => array(
 *       'firstName'    => 'Adam',
 *       'lastName'    => 'Williams'
 *     ),
 *     'creditCard'    => array(
 *       'number'    => '5105105105105100',
 *       'expirationDate'    => '05/2012'
 *     ),
 *     'options'    => array(
 *       'storeInVault'    => true
 *     )
 *   ));
 *
 *  echo $transaction->customerDetails->id
 *  // '865534'
 *  echo $transaction->creditCardDetails->token
 *  // '6b6m'
 * </code>
 *
 * To also store the billing address in the vault, pass the
 * <b>addBillingAddressToPaymentMethod</b> option.
 * <code>
 *   Transaction.saleNoValidate(array(
 *    ...
 *     'options' => array(
 *       'storeInVault' => true
 *       'addBillingAddressToPaymentMethod' => true
 *     )
 *   ));
 * </code>
 *
 * <b>== Submitting for Settlement==</b>
 *
 * This can only be done when the transction's
 * status is <b>authorized</b>. If <b>amount</b> is not specified,
 * the full authorized amount will be settled. If you would like to settle
 * less than the full authorized amount, pass the desired amount.
 * You cannot settle more than the authorized amount.
 *
 * A transaction can be submitted for settlement when created by setting
 * $transaction[options][submitForSettlement] to true.
 *
 * <code>
 *   $transaction = Transaction::saleNoValidate(array(
 *     'amount'    => '100.00',
 *     'creditCard'    => array(
 *       'number'    => '5105105105105100',
 *       'expirationDate'    => '05/2012'
 *     ),
 *     'options'    => array(
 *       'submitForSettlement'    => true
 *     )
 *   ));
 * </code>
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on Transactions, see {@link https://developers.braintreepayments.com/reference/response/transaction/php https://developers.braintreepayments.com/reference/response/transaction/php}
 *
 * @category   Resources
 *
 * @property string                                                $acquirerReferenceNumber
 * @property string                                                $additionalProcessorResponse     raw response from processor
 * @property \Braintree\AddOn[]                                    $addOns
 * @property \Braintree\Transaction\AmexExpressCheckoutCardDetails $amexExpressCheckoutCardDetails  DEPRECATED transaction Amex Express Checkout card info.
 * @property string                                                $amount                          transaction amount
 * @property \Braintree\Transaction\AndroidPayCardDetails          $androidPayCardDetails           transaction Android Pay card info
 * @property \Braintree\Transaction\ApplePayCardDetails            $applePayCardDetails             transaction Apple Pay card info
 * @property \Braintree\AuthorizationAdjustment[]                  $authorizationAdjustments        populated when a transaction has authorization adjustments created when submitted for settlement
 * @property \DateTime                                             $authorizationExpiresAt          DateTime authorization will expire
 * @property string                                                $avsErrorResponseCode
 * @property string                                                $avsPostalCodeResponseCode
 * @property string                                                $avsStreetAddressResponseCode
 * @property \Braintree\Transaction\AddressDetails                 $billingDetails                  transaction billing address
 * @property string                                                $channel
 * @property \DateTime                                             $createdAt                       transaction created DateTime
 * @property \Braintree\Transaction\CreditCardDetails              $creditCardDetails               transaction credit card info
 * @property string                                                $currencyIsoCode
 * @property \Braintree\Transaction\CustomerDetails                $customerDetails                 transaction customer info
 * @property array                                                 $customFields                    custom fields passed with the request
 * @property string                                                $cvvResponseCode
 * @property \Braintree\Descriptor                                 $descriptor
 * @property Braintree\DisbursementDetails                         $disbursementDetails             populated when transaction is disbursed
 * @property string                                                $discountAmount
 * @property \Braintree\Discount[]                                 $discounts
 * @property \Braintree\Dispute[]                                  $disputes                        populated when transaction is disputed
 * @property string                                                $escrowStatus
 * @property \Braintree\FacilitatedDetails                         $facilitatedDetails
 * @property \Braintree\FacilitatorDetails                         $facilitatorDetails
 * @property string                                                $gatewayRejectionReason
 * @property string                                                $graphQLId                       transaction graphQLId
 * @property string                                                $id                              transaction id
 * @property \Braintree\TransactionLineItem[]                      $lineItems
 * @property \Braintree\Transaction\LocalPaymentDetails            $localPaymentDetails             transaction local payment info
 * @property \Braintree\Transaction\MasterpassCardDetails          $masterpassCardDetails           DEPRECATED transaction Masterpass card info
 * @property string                                                $merchantAccountId
 * @property string                                                $networkTransactionId
 * @property string                                                $orderId
 * @property string                                                $paymentInstrumentType
 * @property \Braintree\Transaction\PayPalDetails                  $paypalDetails                   transaction paypal account info
 * @property \Braintree\Transaction\PayPalHereDetails              $paypalHereDetails
 * @property string                                                $planId
 * @property string                                                $processedWithNetworkToken
 * @property string                                                $processorAuthorizationCode
 * @property string                                                $processorResponseCode           gateway response code
 * @property string                                                $processorResponseText
 * @property string                                                $processorResponseType
 * @property string                                                $processorSettlementResponseCode
 * @property string                                                $processorSettlementResponseText
 * @property string                                                $productSku
 * @property string                                                $purchaseOrderNumber
 * @property mixed                                                 $reccuring
 * @property string                                                $refundedTransactionId
 * @property mixed                                                 $refundIds
 * @property string                                                $retrievalReferenceNumber
 * @property \Braintree\RiskData                                   $riskData
 * @property \Braintree\Transaction\SamsungPayCardDetails          $samsungPayCardDetails           transaction Samsung Pay card info
 * @property string                                                $scaExemptionRequested
 * @property string                                                $serviceFeeAmount
 * @property string                                                $settlementBatchId
 * @property string                                                $shippingAmount
 * @property \Braintree\Transaction\AddressDetails                 $shippingDetails                 transaction shipping address
 * @property string                                                $status                          transaction status
 * @property \Braintree\Transaction\StatusDetails[]                $statusHistory                   array of StatusDetails objects
 * @property \Braintree\Transaction\SubscriptionDetails            $subscriptionDetails
 * @property string                                                $subscriptionId
 * @property string                                                $taxAmount
 * @property string                                                $taxExcempt
 * @property \Braintree\ThreeDSecureInfo                           $threeDSecureInfo
 * @property string                                                $type                            transaction type
 * @property \DateTime                                             $updatedAt                       transaction updated DateTime
 * @property \Braintree\VenmoAccount                               $venmoAccountDetails             transaction Venmo Account info
 * @property \Braintree\Transaction\VisaCheckoutCardDetails        $visaCheckoutCardDetails         transaction Visa Checkout card info
 * @property string                                                $voiceReferralName
 */
class Transaction extends Base
{
    // Transaction Status
    public const AUTHORIZATION_EXPIRED = 'authorization_expired';
    public const AUTHORIZING = 'authorizing';
    public const AUTHORIZED = 'authorized';
    public const GATEWAY_REJECTED = 'gateway_rejected';
    public const FAILED = 'failed';
    public const PROCESSOR_DECLINED = 'processor_declined';
    public const SETTLED = 'settled';
    public const SETTLING = 'settling';
    public const SUBMITTED_FOR_SETTLEMENT = 'submitted_for_settlement';
    public const VOIDED = 'voided';
    public const UNRECOGNIZED = 'unrecognized';
    public const SETTLEMENT_DECLINED = 'settlement_declined';
    public const SETTLEMENT_PENDING = 'settlement_pending';
    public const SETTLEMENT_CONFIRMED = 'settlement_confirmed';

    // Transaction Escrow Status
    public const ESCROW_HOLD_PENDING = 'hold_pending';
    public const ESCROW_HELD = 'held';
    public const ESCROW_RELEASE_PENDING = 'release_pending';
    public const ESCROW_RELEASED = 'released';
    public const ESCROW_REFUNDED = 'refunded';

    // Transaction Types
    public const SALE = 'sale';
    public const CREDIT = 'credit';

    // Transaction Created Using
    public const FULL_INFORMATION = 'full_information';
    public const TOKEN = 'token';

    // Transaction Sources
    public const API = 'api';
    public const CONTROL_PANEL = 'control_panel';
    public const RECURRING = 'recurring';

    // Gateway Rejection Reason
    public const AVS = 'avs';
    public const AVS_AND_CVV = 'avs_and_cvv';
    public const CVV = 'cvv';
    public const DUPLICATE = 'duplicate';
    public const FRAUD = 'fraud';
    public const RISK_THRESHOLD = 'risk_threshold';
    public const THREE_D_SECURE = 'three_d_secure';
    public const TOKEN_ISSUANCE = 'token_issuance';
    public const APPLICATION_INCOMPLETE = 'application_incomplete';

    // Industry Types
    public const LODGING_INDUSTRY = 'lodging';
    public const TRAVEL_AND_CRUISE_INDUSTRY = 'travel_cruise';
    public const TRAVEL_AND_FLIGHT_INDUSTRY = 'travel_flight';

    // Additional Charge Types
    public const RESTAURANT = 'lodging';
    public const GIFT_SHOP = 'gift_shop';
    public const MINI_BAR = 'mini_bar';
    public const TELEPHONE = 'telephone';
    public const LAUNDRY = 'laundry';
    public const OTHER = 'other';

    /**
     * returns a string representation of the transaction.
     *
     * @return string
     */
    public function __toString()
    {
        // array of attributes to print
        $display = [
            'id', 'type', 'amount', 'status',
            'createdAt', 'creditCardDetails', 'customerDetails',
        ];

        $displayAttributes = [];

        foreach ($display as $attrib) {
            $displayAttributes[$attrib] = $this->{$attrib};
        }

        return __CLASS__.'['.
                Util::attributesToString($displayAttributes).']';
    }

    public function isEqual($otherTx)
    {
        return $this->id === $otherTx->id;
    }

    public function vaultCreditCard()
    {
        $token = $this->creditCardDetails->token;

        if (empty($token)) {
            return null;
        }

        return CreditCard::find($token);
    }

    /**
     * @return Braintree\Customer|void
     */
    public function vaultCustomer()
    {
        $customerId = $this->customerDetails->id;

        if (empty($customerId)) {
            return null;
        }

        return Customer::find($customerId);
    }

    /**
     * @return bool
     */
    public function isDisbursed()
    {
        return $this->disbursementDetails->isValid();
    }

    /**
     * @return line items
     */
    public function lineItems()
    {
        return Configuration::gateway()->transactionLineItem()->findAll($this->id);
    }

    /**
     *  factory method: returns an instance of Transaction
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return Transaction
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    // static methods redirecting to gateway

    public static function cloneTransaction($transactionId, $attribs)
    {
        return Configuration::gateway()->transaction()->cloneTransaction($transactionId, $attribs);
    }

    public static function createTransactionUrl()
    {
        return Configuration::gateway()->transaction()->createTransactionUrl();
    }

    public static function credit($attribs)
    {
        return Configuration::gateway()->transaction()->credit($attribs);
    }

    public static function creditNoValidate($attribs)
    {
        return Configuration::gateway()->transaction()->creditNoValidate($attribs);
    }

    public static function find($id)
    {
        return Configuration::gateway()->transaction()->find($id);
    }

    public static function sale($attribs)
    {
        return Configuration::gateway()->transaction()->sale($attribs);
    }

    public static function saleNoValidate($attribs)
    {
        return Configuration::gateway()->transaction()->saleNoValidate($attribs);
    }

    public static function search($query)
    {
        return Configuration::gateway()->transaction()->search($query);
    }

    public static function fetch($query, $ids)
    {
        return Configuration::gateway()->transaction()->fetch($query, $ids);
    }

    public static function void($transactionId)
    {
        return Configuration::gateway()->transaction()->void($transactionId);
    }

    public static function voidNoValidate($transactionId)
    {
        return Configuration::gateway()->transaction()->voidNoValidate($transactionId);
    }

    public static function submitForSettlement($transactionId, $amount = null, $attribs = [])
    {
        return Configuration::gateway()->transaction()->submitForSettlement($transactionId, $amount, $attribs);
    }

    public static function submitForSettlementNoValidate($transactionId, $amount = null, $attribs = [])
    {
        return Configuration::gateway()->transaction()->submitForSettlementNoValidate($transactionId, $amount, $attribs);
    }

    public static function updateDetails($transactionId, $attribs = [])
    {
        return Configuration::gateway()->transaction()->updateDetails($transactionId, $attribs);
    }

    public static function submitForPartialSettlement($transactionId, $amount, $attribs = [])
    {
        return Configuration::gateway()->transaction()->submitForPartialSettlement($transactionId, $amount, $attribs);
    }

    public static function holdInEscrow($transactionId)
    {
        return Configuration::gateway()->transaction()->holdInEscrow($transactionId);
    }

    public static function releaseFromEscrow($transactionId)
    {
        return Configuration::gateway()->transaction()->releaseFromEscrow($transactionId);
    }

    public static function cancelRelease($transactionId)
    {
        return Configuration::gateway()->transaction()->cancelRelease($transactionId);
    }

    public static function refund($transactionId, $amount = null)
    {
        return Configuration::gateway()->transaction()->refund($transactionId, $amount);
    }

    /**
     * sets instance properties from an array of values.
     *
     * @ignore
     *
     * @param array $transactionAttribs array of transaction data
     */
    protected function _initialize($transactionAttribs): void
    {
        $this->_attributes = $transactionAttribs;

        if (isset($transactionAttribs['applePay'])) {
            $this->_set(
                'applePayCardDetails',
                new Transaction\ApplePayCardDetails(
                    $transactionAttribs['applePay'],
                ),
            );
        }

        // NEXT_MAJOR_VERSION rename Android Pay to Google Pay
        if (isset($transactionAttribs['androidPayCard'])) {
            $this->_set(
                'androidPayCardDetails',
                new Transaction\AndroidPayCardDetails(
                    $transactionAttribs['androidPayCard'],
                ),
            );
        }

        // NEXT_MAJOR_VERSION remove deprecated masterpassCard
        if (isset($transactionAttribs['masterpassCard'])) {
            $this->_set(
                'masterpassCardDetails',
                new Transaction\MasterpassCardDetails(
                    $transactionAttribs['masterpassCard'],
                ),
            );
        }

        if (isset($transactionAttribs['visaCheckoutCard'])) {
            $this->_set(
                'visaCheckoutCardDetails',
                new Transaction\VisaCheckoutCardDetails(
                    $transactionAttribs['visaCheckoutCard'],
                ),
            );
        }

        if (isset($transactionAttribs['samsungPayCard'])) {
            $this->_set(
                'samsungPayCardDetails',
                new Transaction\SamsungPayCardDetails(
                    $transactionAttribs['samsungPayCard'],
                ),
            );
        }

        // NEXT_MAJOR_VERSION remove deprecated amexExpressCheckoutCard
        if (isset($transactionAttribs['amexExpressCheckoutCard'])) {
            $this->_set(
                'amexExpressCheckoutCardDetails',
                new Transaction\AmexExpressCheckoutCardDetails(
                    $transactionAttribs['amexExpressCheckoutCard'],
                ),
            );
        }

        if (isset($transactionAttribs['venmoAccount'])) {
            $this->_set(
                'venmoAccountDetails',
                new Transaction\VenmoAccountDetails(
                    $transactionAttribs['venmoAccount'],
                ),
            );
        }

        if (isset($transactionAttribs['creditCard'])) {
            $this->_set(
                'creditCardDetails',
                new Transaction\CreditCardDetails(
                    $transactionAttribs['creditCard'],
                ),
            );
        }

        if (isset($transactionAttribs['usBankAccount'])) {
            $this->_set(
                'usBankAccount',
                new Transaction\UsBankAccountDetails(
                    $transactionAttribs['usBankAccount'],
                ),
            );
        }

        if (isset($transactionAttribs['paypal'])) {
            $this->_set(
                'paypalDetails',
                new Transaction\PayPalDetails(
                    $transactionAttribs['paypal'],
                ),
            );
        }

        if (isset($transactionAttribs['paypalHere'])) {
            $this->_set(
                'paypalHereDetails',
                new Transaction\PayPalHereDetails(
                    $transactionAttribs['paypalHere'],
                ),
            );
        }

        if (isset($transactionAttribs['localPayment'])) {
            $this->_set(
                'localPaymentDetails',
                new Transaction\LocalPaymentDetails(
                    $transactionAttribs['localPayment'],
                ),
            );
        }

        if (isset($transactionAttribs['customer'])) {
            $this->_set(
                'customerDetails',
                new Transaction\CustomerDetails(
                    $transactionAttribs['customer'],
                ),
            );
        }

        if (isset($transactionAttribs['billing'])) {
            $this->_set(
                'billingDetails',
                new Transaction\AddressDetails(
                    $transactionAttribs['billing'],
                ),
            );
        }

        if (isset($transactionAttribs['shipping'])) {
            $this->_set(
                'shippingDetails',
                new Transaction\AddressDetails(
                    $transactionAttribs['shipping'],
                ),
            );
        }

        if (isset($transactionAttribs['subscription'])) {
            $this->_set(
                'subscriptionDetails',
                new Transaction\SubscriptionDetails(
                    $transactionAttribs['subscription'],
                ),
            );
        }

        if (isset($transactionAttribs['descriptor'])) {
            $this->_set(
                'descriptor',
                new Descriptor(
                    $transactionAttribs['descriptor'],
                ),
            );
        }

        if (isset($transactionAttribs['disbursementDetails'])) {
            $this->_set(
                'disbursementDetails',
                new DisbursementDetails($transactionAttribs['disbursementDetails']),
            );
        }

        $disputes = [];

        if (isset($transactionAttribs['disputes'])) {
            foreach ($transactionAttribs['disputes'] as $dispute) {
                $disputes[] = Dispute::factory($dispute);
            }
        }

        $this->_set('disputes', $disputes);

        $statusHistory = [];

        if (isset($transactionAttribs['statusHistory'])) {
            foreach ($transactionAttribs['statusHistory'] as $history) {
                $statusHistory[] = new Transaction\StatusDetails($history);
            }
        }

        $this->_set('statusHistory', $statusHistory);

        $addOnArray = [];

        if (isset($transactionAttribs['addOns'])) {
            foreach ($transactionAttribs['addOns'] as $addOn) {
                $addOnArray[] = AddOn::factory($addOn);
            }
        }

        $this->_set('addOns', $addOnArray);

        $discountArray = [];

        if (isset($transactionAttribs['discounts'])) {
            foreach ($transactionAttribs['discounts'] as $discount) {
                $discountArray[] = Discount::factory($discount);
            }
        }

        $this->_set('discounts', $discountArray);

        $authorizationAdjustments = [];

        if (isset($transactionAttribs['authorizationAdjustments'])) {
            foreach ($transactionAttribs['authorizationAdjustments'] as $authorizationAdjustment) {
                $authorizationAdjustments[] = AuthorizationAdjustment::factory($authorizationAdjustment);
            }
        }

        $this->_set('authorizationAdjustments', $authorizationAdjustments);

        if (isset($transactionAttribs['riskData'])) {
            $this->_set('riskData', RiskData::factory($transactionAttribs['riskData']));
        }

        if (isset($transactionAttribs['threeDSecureInfo'])) {
            $this->_set('threeDSecureInfo', ThreeDSecureInfo::factory($transactionAttribs['threeDSecureInfo']));
        }

        if (isset($transactionAttribs['facilitatedDetails'])) {
            $this->_set('facilitatedDetails', FacilitatedDetails::factory($transactionAttribs['facilitatedDetails']));
        }

        if (isset($transactionAttribs['facilitatorDetails'])) {
            $this->_set('facilitatorDetails', FacilitatorDetails::factory($transactionAttribs['facilitatorDetails']));
        }
    }
}
