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
 * Braintree Customer module
 * Creates and manages Customers.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on Customers, see {@link https://developers.braintreepayments.com/reference/response/customer/php https://developers.braintreepayments.com/reference/response/customer/php}
 *
 * @category   Resources
 *
 * @property \Braintree\Address[]                 $addresses
 * @property \Braintree\AmexExpressCheckoutCard[] $amexExpressCheckoutCards DEPRECATED
 * @property \Braintree\AndroidPayCard[]          $androidPayCards
 * @property \Braintree\ApplePayCard[]            $applePayCards
 * @property string                               $company
 * @property \DateTime                            $createdAt
 * @property \Braintree\CreditCard[]              $creditCards
 * @property array                                $customFields             custom fields passed with the request
 * @property string                               $email
 * @property string                               $fax
 * @property string                               $firstName
 * @property string                               $graphQLId
 * @property string                               $id
 * @property string                               $lastName
 * @property \Braintree\MasterpassCard[]          $masterpassCards          DEPRECATED
 * @property \Braintree\PaymentMethod[]           $paymentMethods
 * @property \Braintree\PayPalAccount[]           $paypalAccounts
 * @property string                               $phone
 * @property \Braintree\SamsungPayCard[]          $samsungPayCards
 * @property \DateTime                            $updatedAt
 * @property \Braintree\UsBankAccount[]           $usBankAccounts
 * @property \Braintree\VenmoAccount[]            $venmoAccounts
 * @property \Braintree\VisaCheckoutCard[]        $visaCheckoutCards
 * @property string                               $website
 */
class Customer extends Base
{
    /* private class properties */

    /**
     * @var array registry of customer data
     */
    protected array $_attributes = [
        'addresses' => '',
        'company' => '',
        'creditCards' => '',
        'email' => '',
        'fax' => '',
        'firstName' => '',
        'id' => '',
        'lastName' => '',
        'phone' => '',
        'createdAt' => '',
        'updatedAt' => '',
        'website' => '',
    ];

    /**
     * returns a string representation of the customer.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__.'['.
                Util::attributesToString($this->_attributes).']';
    }
    /**
     * @return Customer[]
     */
    public static function all()
    {
        return Configuration::gateway()->customer()->all();
    }

    /**
     * @param array $query
     * @param int[] $ids
     *
     * @return Customer|Customer[]
     */
    public static function fetch($query, $ids)
    {
        return Configuration::gateway()->customer()->fetch($query, $ids);
    }

    /**
     * @param array $attribs
     *
     * @return Result\Error|Result\Successful
     */
    public static function create($attribs = [])
    {
        return Configuration::gateway()->customer()->create($attribs);
    }

    /**
     * @param array $attribs
     *
     * @return Customer
     */
    public static function createNoValidate($attribs = [])
    {
        return Configuration::gateway()->customer()->createNoValidate($attribs);
    }

    /**
     * @param string     $id                  customer id
     * @param null|mixed $associationFilterId
     *
     * @throws Exception\NotFound
     *
     * @return Customer
     */
    public static function find($id, $associationFilterId = null)
    {
        return Configuration::gateway()->customer()->find($id, $associationFilterId);
    }

    /**
     * @param int   $customerId
     * @param array $transactionAttribs
     *
     * @return Result\Error|Result\Successful
     */
    public static function credit($customerId, $transactionAttribs)
    {
        return Configuration::gateway()->customer()->credit($customerId, $transactionAttribs);
    }

    /**
     * @param type $customerId
     * @param type $transactionAttribs
     *
     * @throws Exception\ValidationError
     *
     * @return Transaction
     */
    public static function creditNoValidate($customerId, $transactionAttribs)
    {
        return Configuration::gateway()->customer()->creditNoValidate($customerId, $transactionAttribs);
    }

    /**
     * @param int $customerId
     *
     * @throws Exception on invalid id or non-200 http response code
     *
     * @return Result\Successful
     */
    public static function delete($customerId)
    {
        return Configuration::gateway()->customer()->delete($customerId);
    }

    /**
     * @param int   $customerId
     * @param array $transactionAttribs
     *
     * @return Transaction
     */
    public static function sale($customerId, $transactionAttribs)
    {
        return Configuration::gateway()->customer()->sale($customerId, $transactionAttribs);
    }

    /**
     * @param int   $customerId
     * @param array $transactionAttribs
     *
     * @return Transaction
     */
    public static function saleNoValidate($customerId, $transactionAttribs)
    {
        return Configuration::gateway()->customer()->saleNoValidate($customerId, $transactionAttribs);
    }

    /**
     * @param array $query
     *
     * @throws InvalidArgumentException
     *
     * @return ResourceCollection
     */
    public static function search($query)
    {
        return Configuration::gateway()->customer()->search($query);
    }

    /**
     * @param int   $customerId
     * @param array $attributes
     *
     * @throws Exception\Unexpected
     *
     * @return Result\Error|Result\Successful
     */
    public static function update($customerId, $attributes)
    {
        return Configuration::gateway()->customer()->update($customerId, $attributes);
    }

    /**
     * @param int   $customerId
     * @param array $attributes
     *
     * @throws Exception\Unexpected
     *
     * @return CustomerGateway
     */
    public static function updateNoValidate($customerId, $attributes)
    {
        return Configuration::gateway()->customer()->updateNoValidate($customerId, $attributes);
    }

    /**
     * returns false if comparing object is not a Customer,
     * or is a Customer with a different id.
     *
     * @param object $otherCust customer to compare against
     *
     * @return bool
     */
    public function isEqual($otherCust)
    {
        return !($otherCust instanceof self) ? false : $this->id === $otherCust->id;
    }

    /**
     * returns the customer's default payment method.
     *
     * @return CreditCard|PayPalAccount
     */
    public function defaultPaymentMethod()
    {
        $defaultPaymentMethods = array_filter($this->paymentMethods, 'Braintree\Customer::_defaultPaymentMethodFilter');

        return current($defaultPaymentMethods);
    }

    public static function _defaultPaymentMethodFilter($paymentMethod)
    {
        return $paymentMethod->isDefault();
    }

    /**
     *  factory method: returns an instance of Customer
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param array $attributes
     *
     * @return Customer
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    /* instance methods */

    /**
     * sets instance properties from an array of values.
     *
     * @ignore
     *
     * @param array $customerAttribs array of customer data
     */
    protected function _initialize($customerAttribs): void
    {
        $this->_attributes = $customerAttribs;

        $addressArray = [];

        if (isset($customerAttribs['addresses'])) {
            foreach ($customerAttribs['addresses'] as $address) {
                $addressArray[] = Address::factory($address);
            }
        }

        $this->_set('addresses', $addressArray);

        $creditCardArray = [];

        if (isset($customerAttribs['creditCards'])) {
            foreach ($customerAttribs['creditCards'] as $creditCard) {
                $creditCardArray[] = CreditCard::factory($creditCard);
            }
        }

        $this->_set('creditCards', $creditCardArray);

        $paypalAccountArray = [];

        if (isset($customerAttribs['paypalAccounts'])) {
            foreach ($customerAttribs['paypalAccounts'] as $paypalAccount) {
                $paypalAccountArray[] = PayPalAccount::factory($paypalAccount);
            }
        }

        $this->_set('paypalAccounts', $paypalAccountArray);

        $applePayCardArray = [];

        if (isset($customerAttribs['applePayCards'])) {
            foreach ($customerAttribs['applePayCards'] as $applePayCard) {
                $applePayCardArray[] = ApplePayCard::factory($applePayCard);
            }
        }

        $this->_set('applePayCards', $applePayCardArray);

        // NEXT_MAJOR_VERSION rename Android Pay to Google Pay
        $androidPayCardArray = [];

        if (isset($customerAttribs['androidPayCards'])) {
            foreach ($customerAttribs['androidPayCards'] as $androidPayCard) {
                $androidPayCardArray[] = AndroidPayCard::factory($androidPayCard);
            }
        }

        $this->_set('androidPayCards', $androidPayCardArray);

        // NEXT_MAJOR_VERSION remove deprecated AmexExpressCheckout
        $amexExpressCheckoutCardArray = [];

        if (isset($customerAttribs['amexExpressCheckoutCards'])) {
            foreach ($customerAttribs['amexExpressCheckoutCards'] as $amexExpressCheckoutCard) {
                $amexExpressCheckoutCardArray[] = AmexExpressCheckoutCard::factory($amexExpressCheckoutCard);
            }
        }

        $this->_set('amexExpressCheckoutCards', $amexExpressCheckoutCardArray);

        $venmoAccountArray = [];

        if (isset($customerAttribs['venmoAccounts'])) {
            foreach ($customerAttribs['venmoAccounts'] as $venmoAccount) {
                $venmoAccountArray[] = VenmoAccount::factory($venmoAccount);
            }
        }

        $this->_set('venmoAccounts', $venmoAccountArray);

        $visaCheckoutCardArray = [];

        if (isset($customerAttribs['visaCheckoutCards'])) {
            foreach ($customerAttribs['visaCheckoutCards'] as $visaCheckoutCard) {
                $visaCheckoutCardArray[] = VisaCheckoutCard::factory($visaCheckoutCard);
            }
        }

        $this->_set('visaCheckoutCards', $visaCheckoutCardArray);

        // NEXT_MAJOR_VERSION remove deprecated Masterpass
        $masterpassCardArray = [];

        if (isset($customerAttribs['masterpassCards'])) {
            foreach ($customerAttribs['masterpassCards'] as $masterpassCard) {
                $masterpassCardArray[] = MasterpassCard::factory($masterpassCard);
            }
        }

        $this->_set('masterpassCards', $masterpassCardArray);

        $samsungPayCardArray = [];

        if (isset($customerAttribs['samsungPayCards'])) {
            foreach ($customerAttribs['samsungPayCards'] as $samsungPayCard) {
                $samsungPayCardArray[] = SamsungPayCard::factory($samsungPayCard);
            }
        }

        $this->_set('samsungPayCards', $samsungPayCardArray);

        $usBankAccountArray = [];

        if (isset($customerAttribs['usBankAccounts'])) {
            foreach ($customerAttribs['usBankAccounts'] as $usBankAccount) {
                $usBankAccountArray[] = UsBankAccount::factory($usBankAccount);
            }
        }

        $this->_set('usBankAccounts', $usBankAccountArray);

        $this->_set('paymentMethods', array_merge(
            $this->creditCards,
            $this->paypalAccounts,
            $this->applePayCards,
            $this->androidPayCards,
            $this->amexExpressCheckoutCards,
            $this->venmoAccounts,
            $this->visaCheckoutCards,
            $this->masterpassCards,
            $this->samsungPayCards,
            $this->usBankAccounts,
        ));

        $customFields = [];

        if (isset($customerAttribs['customFields'])) {
            $customFields = $customerAttribs['customFields'];
        }

        $this->_set('customFields', $customFields);
    }
}
