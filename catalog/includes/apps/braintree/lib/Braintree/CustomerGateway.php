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
 * Braintree CustomerGateway module
 * Creates and manages Customers.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on Customers, see {@link https://developers.braintreepayments.com/reference/response/customer/php https://developers.braintreepayments.com/reference/response/customer/php}
 *
 * @category   Resources
 */
class CustomerGateway
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
    private $_gateway;
    private $_config;
    private $_http;

    public function __construct($gateway)
    {
        $this->_gateway = $gateway;
        $this->_config = $gateway->config;
        $this->_config->assertHasAccessTokenOrKeys();
        $this->_http = new Http($gateway->config);
    }

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

    public function all()
    {
        $path = $this->_config->merchantPath().'/customers/advanced_search_ids';
        $response = $this->_http->post($path);
        $pager = [
            'object' => $this,
            'method' => 'fetch',
            'methodArgs' => [[]],
        ];

        return new ResourceCollection($response, $pager);
    }

    public function fetch($query, $ids)
    {
        $criteria = [];

        foreach ($query as $term) {
            $criteria[$term->name] = $term->toparam();
        }

        $criteria['ids'] = CustomerSearch::ids()->in($ids)->toparam();
        $path = $this->_config->merchantPath().'/customers/advanced_search';
        $response = $this->_http->post($path, ['search' => $criteria]);

        return Util::extractattributeasarray(
            $response['customers'],
            'customer',
        );
    }

    /**
     * Creates a customer using the given +attributes+. If <tt>:id</tt> is not passed,
     * the gateway will generate it.
     *
     * <code>
     *   $result = Customer::create(array(
     *     'first_name' => 'John',
     *     'last_name' => 'Smith',
     *     'company' => 'Smith Co.',
     *     'email' => 'john@smith.com',
     *     'website' => 'www.smithco.com',
     *     'fax' => '419-555-1234',
     *     'phone' => '614-555-1234'
     *   ));
     *   if($result->success) {
     *     echo 'Created customer ' . $result->customer->id;
     *   } else {
     *     echo 'Could not create customer, see result->errors';
     *   }
     * </code>
     *
     * @param array $attribs (Note: $deviceSessionId and $fraudMerchantId params are deprecated. Use $deviceData instead)
     *
     * @return Result\Error|Result\Successful
     */
    public function create($attribs = [])
    {
        Util::verifyKeys(self::createSignature(), $attribs);
        $this->_checkForDeprecatedAttributes($attribs);

        return $this->_doCreate('/customers', ['customer' => $attribs]);
    }

    /**
     * attempts the create operation assuming all data will validate
     * returns a Customer object instead of a Result.
     *
     * @param array $attribs
     *
     * @throws Exception\ValidationError
     *
     * @return Customer
     */
    public function createNoValidate($attribs = [])
    {
        $result = $this->create($attribs);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
    }

    /**
     * creates a full array signature of a valid create request.
     *
     * @return array gateway create request format
     */
    public static function createSignature()
    {
        $creditCardSignature = CreditCardGateway::createSignature();
        unset($creditCardSignature[array_search('customerId', $creditCardSignature, true)]);

        return [
            'id', 'company', 'email', 'fax', 'firstName',
            'lastName', 'phone', 'website', 'deviceData', 'paymentMethodNonce',
            'deviceSessionId', 'fraudMerchantId', // NEXT_MAJOR_VERSION remove deviceSessionId and fraudMerchantId
            ['riskData' => ['customerBrowser', 'customerIp', 'customer_browser', 'customer_ip'],
            ],
            ['creditCard' => $creditCardSignature],
            ['customFields' => ['_anyKey_']],
            ['options' => [
                ['paypal' => [
                    'payee_email',
                    'payeeEmail',
                    'order_id',
                    'orderId',
                    'custom_field',
                    'customField',
                    'description',
                    'amount',
                    ['shipping' => [
                        'firstName', 'lastName', 'company', 'countryName',
                        'countryCodeAlpha2', 'countryCodeAlpha3', 'countryCodeNumeric',
                        'extendedAddress', 'locality', 'postalCode', 'region',
                        'streetAddress'],
                    ],
                ]],
            ]],
        ];
    }

    /**
     * creates a full array signature of a valid update request.
     *
     * @return array update request format
     */
    public static function updateSignature()
    {
        $creditCardSignature = CreditCardGateway::updateSignature();

        foreach ($creditCardSignature as $key => $value) {
            if (\is_array($value) && \array_key_exists('options', $value)) {
                $creditCardSignature[$key]['options'][] = 'updateExistingToken';
            }
        }

        return [
            'id', 'company', 'email', 'fax', 'firstName',
            'lastName', 'phone', 'website', 'deviceData',
            'paymentMethodNonce', 'defaultPaymentMethodToken',
            'deviceSessionId', 'fraudMerchantId', // NEXT_MAJOR_VERSION Remove deviceSessionId and fraudMerchantId
            ['creditCard' => $creditCardSignature],
            ['customFields' => ['_anyKey_']],
            ['options' => [
                ['paypal' => [
                    'payee_email',
                    'payeeEmail',
                    'order_id',
                    'orderId',
                    'custom_field',
                    'customField',
                    'description',
                    'amount',
                    ['shipping' => [
                        'firstName', 'lastName', 'company', 'countryName',
                        'countryCodeAlpha2', 'countryCodeAlpha3', 'countryCodeNumeric',
                        'extendedAddress', 'locality', 'postalCode', 'region',
                        'streetAddress'],
                    ],
                ]],
            ]],
        ];
    }

    /**
     * find a customer by id.
     *
     * @param mixed      $id
     * @param null|mixed $associationFilterId
     * @param string id customer Id
     * @param string associationFilterId association filter Id
     *
     * @throws Exception\NotFound
     *
     * @return bool|Customer the customer object or false if the request fails
     */
    public function find($id, $associationFilterId = null)
    {
        $this->_validateId($id);

        try {
            $queryParams = '';

            if ($associationFilterId) {
                $queryParams = '?association_filter_id='.$associationFilterId;
            }

            $path = $this->_config->merchantPath().'/customers/'.$id.$queryParams;
            $response = $this->_http->get($path);

            return Customer::factory($response['customer']);
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound(
                'customer with id '.$id.' not found',
            );
        }
    }

    /**
     * credit a customer for the passed transaction.
     *
     * @param int   $customerId
     * @param array $transactionAttribs
     *
     * @return Result\Error|Result\Successful
     */
    public function credit($customerId, $transactionAttribs)
    {
        $this->_validateId($customerId);

        return Transaction::credit(
            array_merge(
                $transactionAttribs,
                ['customerId' => $customerId],
            ),
        );
    }

    /**
     * credit a customer, assuming validations will pass.
     *
     * returns a Transaction object on success
     *
     * @param int   $customerId
     * @param array $transactionAttribs
     *
     * @throws Exception\ValidationError
     *
     * @return Transaction
     */
    public function creditNoValidate($customerId, $transactionAttribs)
    {
        $result = $this->credit($customerId, $transactionAttribs);

        return Util::returnObjectOrThrowException('Braintree\Transaction', $result);
    }

    /**
     * delete a customer by id.
     *
     * @param string $customerId
     */
    public function delete($customerId)
    {
        $this->_validateId($customerId);
        $path = $this->_config->merchantPath().'/customers/'.$customerId;
        $this->_http->delete($path);

        return new Result\Successful();
    }

    /**
     * create a new sale for a customer.
     *
     * @param string $customerId
     * @param array  $transactionAttribs
     *
     * @return Result\Error|Result\Successful
     *
     * @see Transaction::sale()
     */
    public function sale($customerId, $transactionAttribs)
    {
        $this->_validateId($customerId);

        return Transaction::sale(
            array_merge(
                $transactionAttribs,
                ['customerId' => $customerId],
            ),
        );
    }

    /**
     * create a new sale for a customer, assuming validations will pass.
     *
     * returns a Transaction object on success
     *
     * @param string $customerId
     * @param array  $transactionAttribs
     *
     * @throws Exception\ValidationsFailed
     *
     * @return Transaction
     *
     * @see Transaction::sale()
     */
    public function saleNoValidate($customerId, $transactionAttribs)
    {
        $result = $this->sale($customerId, $transactionAttribs);

        return Util::returnObjectOrThrowException('Braintree\Transaction', $result);
    }

    /**
     * Returns a ResourceCollection of customers matching the search query.
     *
     * If <b>query</b> is a string, the search will be a basic search.
     * If <b>query</b> is a hash, the search will be an advanced search.
     * For more detailed information and examples, see {@link https://developers.braintreepayments.com/reference/request/customer/search/php https://developers.braintreepayments.com/reference/request/customer/search/php}
     *
     * @param mixed $query search query
     *
     * @throws \InvalidArgumentException
     *
     * @return ResourceCollection
     */
    public function search($query)
    {
        $criteria = [];

        foreach ($query as $term) {
            $result = $term->toparam();

            if (null === $result || empty($result)) {
                throw new \InvalidArgumentException('Operator must be provided');
            }

            $criteria[$term->name] = $term->toparam();
        }

        $path = $this->_config->merchantPath().'/customers/advanced_search_ids';
        $response = $this->_http->post($path, ['search' => $criteria]);
        $pager = [
            'object' => $this,
            'method' => 'fetch',
            'methodArgs' => [$query],
        ];

        return new ResourceCollection($response, $pager);
    }

    /**
     * updates the customer record.
     *
     * if calling this method in static context, customerId
     * is the 2nd attribute. customerId is not sent in object context.
     *
     * @param string $customerId (optional)
     * @param array  $attributes (Note: $deviceSessionId and fraudMerchantId params are deprecated. Use $deviceData instead)
     *
     * @return Result\Error|Result\Successful
     */
    public function update($customerId, $attributes)
    {
        Util::verifyKeys(self::updateSignature(), $attributes);
        $this->_validateId($customerId);
        $this->_checkForDeprecatedAttributes($attributes);

        return $this->_doUpdate(
            'put',
            '/customers/'.$customerId,
            ['customer' => $attributes],
        );
    }

    /**
     * update a customer record, assuming validations will pass.
     *
     * if calling this method in static context, customerId
     * is the 2nd attribute. customerId is not sent in object context.
     * returns a Customer object on success
     *
     * @param string $customerId
     * @param array  $attributes
     *
     * @throws Exception\ValidationsFailed
     *
     * @return Customer
     */
    public function updateNoValidate($customerId, $attributes)
    {
        $result = $this->update($customerId, $attributes);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
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
        return !($otherCust instanceof Customer) ? false : $this->id === $otherCust->id;
    }

    /**
     * returns an array containt all of the customer's payment methods.
     *
     * @return array
     */
    public function paymentMethods()
    {
        return $this->paymentMethods;
    }

    /**
     * returns the customer's default payment method.
     *
     * @return AndroidPayCard|ApplePayCard|CreditCard|PayPalAccount
     */
    public function defaultPaymentMethod()
    {
        $defaultPaymentMethods = array_filter($this->paymentMethods, 'Braintree\\Customer::_defaultPaymentMethodFilter');

        return current($defaultPaymentMethods);
    }

    public static function _defaultPaymentMethodFilter($paymentMethod)
    {
        return $paymentMethod->isDefault();
    }

    /**
     * sends the create request to the gateway.
     *
     * @ignore
     *
     * @param string $subPath
     * @param array  $params
     *
     * @return mixed
     */
    public function _doCreate($subPath, $params)
    {
        $fullPath = $this->_config->merchantPath().$subPath;
        $response = $this->_http->post($fullPath, $params);

        return $this->_verifyGatewayResponse($response);
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
        // set the attributes
        $this->_attributes = $customerAttribs;

        // map each address into its own object
        $addressArray = [];

        if (isset($customerAttribs['addresses'])) {
            foreach ($customerAttribs['addresses'] as $address) {
                $addressArray[] = Address::factory($address);
            }
        }

        $this->_set('addresses', $addressArray);

        // map each creditCard into its own object
        $creditCardArray = [];

        if (isset($customerAttribs['creditCards'])) {
            foreach ($customerAttribs['creditCards'] as $creditCard) {
                $creditCardArray[] = CreditCard::factory($creditCard);
            }
        }

        $this->_set('creditCards', $creditCardArray);

        // map each paypalAccount into its own object
        $paypalAccountArray = [];

        if (isset($customerAttribs['paypalAccounts'])) {
            foreach ($customerAttribs['paypalAccounts'] as $paypalAccount) {
                $paypalAccountArray[] = PayPalAccount::factory($paypalAccount);
            }
        }

        $this->_set('paypalAccounts', $paypalAccountArray);

        // map each applePayCard into its own object
        $applePayCardArray = [];

        if (isset($customerAttribs['applePayCards'])) {
            foreach ($customerAttribs['applePayCards'] as $applePayCard) {
                $applePayCardArray[] = ApplePayCard::factory($applePayCard);
            }
        }

        $this->_set('applePayCards', $applePayCardArray);

        // map each androidPayCard into its own object
        // NEXT_MAJOR_VERSION rename Android Pay to Google Pay
        $androidPayCardArray = [];

        if (isset($customerAttribs['androidPayCards'])) {
            foreach ($customerAttribs['androidPayCards'] as $androidPayCard) {
                $androidPayCardArray[] = AndroidPayCard::factory($androidPayCard);
            }
        }

        $this->_set('androidPayCards', $androidPayCardArray);

        $this->_set('paymentMethods', array_merge($this->creditCards, $this->paypalAccounts, $this->applePayCards, $this->androidPayCards));
    }

    /**
     * verifies that a valid customer id is being used.
     *
     * @ignore
     *
     * @param null|mixed $id
     * @param string customer id
     *
     * @throws \InvalidArgumentException
     */
    private function _validateId($id = null): void
    {
        if (null === $id) {
            throw new \InvalidArgumentException(
                'expected customer id to be set',
            );
        }

        if (!preg_match('/^[0-9A-Za-z_-]+$/', $id)) {
            throw new \InvalidArgumentException(
                $id.' is an invalid customer id.',
            );
        }
    }

    /* private class methods */

    /**
     * sends the update request to the gateway.
     *
     * @ignore
     *
     * @param mixed  $httpVerb
     * @param string $subPath
     * @param array  $params
     *
     * @return mixed
     */
    private function _doUpdate($httpVerb, $subPath, $params)
    {
        $fullPath = $this->_config->merchantPath().$subPath;
        $response = $this->_http->{$httpVerb}($fullPath, $params);

        return $this->_verifyGatewayResponse($response);
    }

    /**
     * generic method for validating incoming gateway responses.
     *
     * creates a new Customer object and encapsulates
     * it inside a Result\Successful object, or
     * encapsulates a Errors object inside a Result\Error
     * alternatively, throws an Unexpected exception if the response is invalid.
     *
     * @ignore
     *
     * @param array $response gateway response values
     *
     * @throws Exception\Unexpected
     *
     * @return Result\Error|Result\Successful
     */
    private function _verifyGatewayResponse($response)
    {
        if (isset($response['customer'])) {
            // return a populated instance of Customer
            return new Result\Successful(
                Customer::factory($response['customer']),
            );
        }

        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        throw new Exception\Unexpected(
            'Expected customer or apiErrorResponse',
        );
    }

    private function _checkForDeprecatedAttributes($attributes): void
    {
        if (isset($attributes['deviceSessionId'])) {
            trigger_error('$deviceSessionId is deprecated, use $deviceData instead', \E_USER_DEPRECATED);
        }

        if (isset($attributes['fraudMerchantId'])) {
            trigger_error('$fraudMerchantId is deprecated, use $deviceData instead', \E_USER_DEPRECATED);
        }
    }
}
