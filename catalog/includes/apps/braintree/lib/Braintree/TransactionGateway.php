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
 * Braintree TransactionGateway processor
 * Creates and manages transactions.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on Transactions, see {@link https://developers.braintreepayments.com/reference/response/transaction/php https://developers.braintreepayments.com/reference/response/transaction/php}
 *
 * @category   Resources
 */
class TransactionGateway
{
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

    public function cloneTransaction($transactionId, $attribs)
    {
        Util::verifyKeys(self::cloneSignature(), $attribs);

        return $this->_doCreate('/transactions/'.$transactionId.'/clone', ['transactionClone' => $attribs]);
    }

    public static function cloneSignature()
    {
        return ['amount', 'channel', ['options' => ['submitForSettlement']]];
    }

    /**
     * creates a full array signature of a valid gateway request.
     *
     * @return array gateway request signature format
     */
    public static function createSignature()
    {
        return [
            'amount',
            'billingAddressId',
            'channel',
            'customerId',
            'deviceData',
            'merchantAccountId',
            'orderId',
            'paymentMethodNonce',
            'paymentMethodToken',
            'productSku',
            'purchaseOrderNumber',
            'recurring',
            'serviceFeeAmount',
            'sharedPaymentMethodToken',
            'sharedPaymentMethodNonce',
            'sharedCustomerId',
            'sharedShippingAddressId',
            'sharedBillingAddressId',
            'shippingAddressId',
            'taxAmount',
            'taxExempt',
            'threeDSecureToken',
            'threeDSecureAuthenticationId',
            'transactionSource',
            'type',
            'venmoSdkPaymentMethodCode',
            'scaExemption',
            'shippingAmount',
            'discountAmount',
            'shipsFromPostalCode',
            'deviceSessionId', 'fraudMerchantId', // NEXT_MAJOR_VERSION remove deviceSessionId and fraudMerchantId
            ['riskData' => [
                // NEXT_MAJOR_VERSION remove snake case parameters, PHP should only accept camel case
                'customerBrowser', 'customerIp', 'customer_browser', 'customer_ip',
                'customerDeviceId', 'customerLocationZip', 'customerTenure'],
            ],
            ['creditCard' => ['token', 'cardholderName', 'cvv', 'expirationDate', 'expirationMonth', 'expirationYear', 'number'],
            ],
            ['customer' => [
                'id', 'company', 'email', 'fax', 'firstName',
                'lastName', 'phone', 'website'],
            ],
            ['billing' => [
                'firstName', 'lastName', 'company', 'countryName',
                'countryCodeAlpha2', 'countryCodeAlpha3', 'countryCodeNumeric',
                'extendedAddress', 'locality', 'phoneNumber', 'postalCode', 'region',
                'streetAddress'],
            ],
            ['shipping' => [
                'firstName', 'lastName', 'company', 'countryName',
                'countryCodeAlpha2', 'countryCodeAlpha3', 'countryCodeNumeric',
                'extendedAddress', 'locality', 'phoneNumber', 'postalCode', 'region',
                'shippingMethod', 'streetAddress'],
            ],
            ['threeDSecurePassThru' => [
                'eciFlag',
                'cavv',
                'xid',
                'threeDSecureVersion',
                'authenticationResponse',
                'directoryResponse',
                'cavvAlgorithm',
                'dsTransactionId'],
            ],
            ['options' => [
                'holdInEscrow',
                'storeInVault',
                'storeInVaultOnSuccess',
                'submitForSettlement',
                'addBillingAddressToPaymentMethod',
                'venmoSdkSession',
                'storeShippingAddressInVault',
                'payeeId',
                'payeeEmail',
                'skipAdvancedFraudChecking',
                'skipAvs',
                'skipCvv',
                ['creditCard' => ['accountType'],
                ],
                ['threeDSecure' => ['required'],
                ],
                ['paypal' => [
                    'payeeId',
                    'payeeEmail',
                    'customField',
                    'description',
                    ['supplementaryData' => ['_anyKey_']],
                ],
                ],
                ['amexRewards' => [
                    'requestId',
                    'points',
                    'currencyAmount',
                    'currencyIsoCode',
                ],
                ],
                ['venmo' => [
                    'profileId',
                ],
                ],
            ],
            ],
            ['customFields' => ['_anyKey_']],
            ['descriptor' => ['name', 'phone', 'url']],
            ['paypalAccount' => ['payeeId', 'payeeEmail', 'payerId', 'paymentId']],
            ['applePayCard' => ['number', 'cardholderName', 'cryptogram', 'expirationMonth', 'expirationYear', 'eciIndicator']],
            ['industry' => ['industryType',
                ['data' => [
                    'folioNumber',
                    'checkInDate',
                    'checkOutDate',
                    'travelPackage',
                    'departureDate',
                    'lodgingCheckInDate',
                    'lodgingCheckOutDate',
                    'lodgingName',
                    'roomRate',
                    'roomTax',
                    'passengerFirstName',
                    'passengerLastName',
                    'passengerMiddleInitial',
                    'passengerTitle',
                    'issuedDate',
                    'travelAgencyName',
                    'travelAgencyCode',
                    'ticketNumber',
                    'issuingCarrierCode',
                    'customerCode',
                    'fareAmount',
                    'feeAmount',
                    'taxAmount',
                    'restrictedTicket',
                    'noShow',
                    'advancedDeposit',
                    'fireSafe',
                    'propertyPhone',
                    ['legs' => [
                        'conjunctionTicket',
                        'exchangeTicket',
                        'couponNumber',
                        'serviceClass',
                        'carrierCode',
                        'fareBasisCode',
                        'flightNumber',
                        'departureDate',
                        'departureAirportCode',
                        'departureTime',
                        'arrivalAirportCode',
                        'arrivalTime',
                        'stopoverPermitted',
                        'fareAmount',
                        'feeAmount',
                        'taxAmount',
                        'endorsementOrRestrictions',
                    ],
                    ],
                    ['additionalCharges' => [
                        'kind',
                        'amount',
                    ],
                    ],
                ],
                ],
            ],
            ],
            ['lineItems' => ['quantity', 'name', 'description', 'kind', 'unitAmount', 'unitTaxAmount', 'totalAmount', 'discountAmount', 'taxAmount', 'unitOfMeasure', 'productCode', 'commodityCode', 'url']],
            ['externalVault' => ['status', 'previousNetworkTransactionId'],
            ],
            // NEXT_MAJOR_VERSION rename Android Pay to Google Pay
            ['androidPayCard' => ['number', 'cryptogram', 'expirationMonth', 'expirationYear', 'eciIndicator', 'sourceCardType', 'sourceCardLastFour', 'googleTransactionId']],
            ['installments' => ['count']],
        ];
    }

    public static function submitForSettlementSignature()
    {
        return ['orderId', ['descriptor' => ['name', 'phone', 'url']],
            'purchaseOrderNumber',
            'taxAmount',
            'taxExempt',
            'shippingAmount',
            'discountAmount',
            'shipsFromPostalCode',
            ['lineItems' => ['quantity', 'name', 'description', 'kind', 'unitAmount', 'unitTaxAmount', 'totalAmount', 'discountAmount', 'taxAmount', 'unitOfMeasure', 'productCode', 'commodityCode', 'url']],
        ];
    }

    public static function updateDetailsSignature()
    {
        return ['amount', 'orderId', ['descriptor' => ['name', 'phone', 'url']]];
    }

    public static function refundSignature()
    {
        return ['amount', 'orderId'];
    }

    /**
     * @param array $attribs
     *
     * @return Result\Error|Result\Successful
     */
    public function credit($attribs)
    {
        return $this->create(array_merge($attribs, ['type' => Transaction::CREDIT]));
    }

    /**
     * @param array $attribs
     *
     * @throws Exception\ValidationError
     *
     * @return Result\Error|Result\Successful
     */
    public function creditNoValidate($attribs)
    {
        $result = $this->credit($attribs);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
    }

    /**
     * @param mixed $id
     * @param string id
     *
     * @return Transaction
     */
    public function find($id)
    {
        $this->_validateId($id);

        try {
            $path = $this->_config->merchantPath().'/transactions/'.$id;
            $response = $this->_http->get($path);

            return Transaction::factory($response['transaction']);
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound(
                'transaction with id '.$id.' not found',
            );
        }
    }
    /**
     * new sale.
     *
     * @param array $attribs (Note: $recurring param is deprecated. Use $transactionSource instead)
     *
     * @return Result\Error|Result\Successful
     */
    public function sale($attribs)
    {
        if (\array_key_exists('recurring', $attribs)) {
            trigger_error('$recurring is deprecated, use $transactionSource instead', \E_USER_DEPRECATED);
        }

        return $this->create(array_merge(['type' => Transaction::SALE], $attribs));
    }

    /**
     * roughly equivalent to the ruby bang method.
     *
     * @param array $attribs
     *
     * @throws Exception\ValidationsFailed
     *
     * @return array
     */
    public function saleNoValidate($attribs)
    {
        $result = $this->sale($attribs);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
    }

    /**
     * Returns a ResourceCollection of transactions matching the search query.
     *
     * If <b>query</b> is a string, the search will be a basic search.
     * If <b>query</b> is a hash, the search will be an advanced search.
     * For more detailed information and examples, see {@link https://developers.braintreepayments.com/reference/request/transaction/search/php https://developers.braintreepayments.com/reference/request/transaction/search/php}
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
            $criteria[$term->name] = $term->toparam();
        }

        $path = $this->_config->merchantPath().'/transactions/advanced_search_ids';
        $response = $this->_http->post($path, ['search' => $criteria]);

        if (\array_key_exists('searchResults', $response)) {
            $pager = [
                'object' => $this,
                'method' => 'fetch',
                'methodArgs' => [$query],
            ];

            return new ResourceCollection($response, $pager);
        }

        throw new Exception\RequestTimeout();
    }

    public function fetch($query, $ids)
    {
        $criteria = [];

        foreach ($query as $term) {
            $criteria[$term->name] = $term->toparam();
        }

        $criteria['ids'] = TransactionSearch::ids()->in($ids)->toparam();
        $path = $this->_config->merchantPath().'/transactions/advanced_search';
        $response = $this->_http->post($path, ['search' => $criteria]);

        if (\array_key_exists('creditCardTransactions', $response)) {
            return Util::extractattributeasarray(
                $response['creditCardTransactions'],
                'transaction',
            );
        }

        throw new Exception\RequestTimeout();
    }

    /**
     * void a transaction by id.
     *
     * @param mixed $transactionId
     *
     * @return Result\Error|Result\Successful
     */
    public function void($transactionId)
    {
        $this->_validateId($transactionId);

        $path = $this->_config->merchantPath().'/transactions/'.$transactionId.'/void';
        $response = $this->_http->put($path);

        return $this->_verifyGatewayResponse($response);
    }
    /**
     * @param mixed $transactionId
     */
    public function voidNoValidate($transactionId)
    {
        $result = $this->void($transactionId);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
    }

    public function submitForSettlement($transactionId, $amount = null, $attribs = [])
    {
        $this->_validateId($transactionId);
        Util::verifyKeys(self::submitForSettlementSignature(), $attribs);
        $attribs['amount'] = $amount;

        $path = $this->_config->merchantPath().'/transactions/'.$transactionId.'/submit_for_settlement';
        $response = $this->_http->put($path, ['transaction' => $attribs]);

        return $this->_verifyGatewayResponse($response);
    }

    public function submitForSettlementNoValidate($transactionId, $amount = null, $attribs = [])
    {
        $result = $this->submitForSettlement($transactionId, $amount, $attribs);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
    }

    public function updateDetails($transactionId, $attribs = [])
    {
        $this->_validateId($transactionId);
        Util::verifyKeys(self::updateDetailsSignature(), $attribs);

        $path = $this->_config->merchantPath().'/transactions/'.$transactionId.'/update_details';
        $response = $this->_http->put($path, ['transaction' => $attribs]);

        return $this->_verifyGatewayResponse($response);
    }

    public function submitForPartialSettlement($transactionId, $amount, $attribs = [])
    {
        $this->_validateId($transactionId);
        Util::verifyKeys(self::submitForSettlementSignature(), $attribs);
        $attribs['amount'] = $amount;

        $path = $this->_config->merchantPath().'/transactions/'.$transactionId.'/submit_for_partial_settlement';
        $response = $this->_http->post($path, ['transaction' => $attribs]);

        return $this->_verifyGatewayResponse($response);
    }

    public function holdInEscrow($transactionId)
    {
        $this->_validateId($transactionId);

        $path = $this->_config->merchantPath().'/transactions/'.$transactionId.'/hold_in_escrow';
        $response = $this->_http->put($path, []);

        return $this->_verifyGatewayResponse($response);
    }

    public function releaseFromEscrow($transactionId)
    {
        $this->_validateId($transactionId);

        $path = $this->_config->merchantPath().'/transactions/'.$transactionId.'/release_from_escrow';
        $response = $this->_http->put($path, []);

        return $this->_verifyGatewayResponse($response);
    }

    public function cancelRelease($transactionId)
    {
        $this->_validateId($transactionId);

        $path = $this->_config->merchantPath().'/transactions/'.$transactionId.'/cancel_release';
        $response = $this->_http->put($path, []);

        return $this->_verifyGatewayResponse($response);
    }

    public function refund($transactionId, $amount_or_options = null)
    {
        self::_validateId($transactionId);

        if (\gettype($amount_or_options) === 'array') {
            $options = $amount_or_options;
        } else {
            $options = [
                'amount' => $amount_or_options,
            ];
        }

        Util::verifyKeys(self::refundSignature(), $options);

        $params = ['transaction' => $options];
        $path = $this->_config->merchantPath().'/transactions/'.$transactionId.'/refund';
        $response = $this->_http->post($path, $params);

        return $this->_verifyGatewayResponse($response);
    }

    /**
     * sends the create request to the gateway.
     *
     * @ignore
     *
     * @param var   $subPath
     * @param array $params
     *
     * @return Result\Error|Result\Successful
     */
    public function _doCreate($subPath, $params)
    {
        $fullPath = $this->_config->merchantPath().$subPath;
        $response = $this->_http->post($fullPath, $params);

        return $this->_verifyGatewayResponse($response);
    }

    /**
     * @ignore
     *
     * @param array $attribs (Note: $deviceSessionId and $fraudMerchantId params are deprecated. Use $deviceData instead)
     *
     * @return Result\Error|Result\Successful
     */
    private function create($attribs)
    {
        Util::verifyKeys(self::createSignature(), $attribs);
        $this->_checkForDeprecatedAttributes($attribs);

        return $this->_doCreate('/transactions', ['transaction' => $attribs]);
    }

    /**
     * @ignore
     *
     * @param array $attribs
     *
     * @throws Exception\ValidationError
     *
     * @return object
     */
    private function createNoValidate($attribs)
    {
        $result = $this->create($attribs);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
    }

    /**
     * verifies that a valid transaction id is being used.
     *
     * @ignore
     *
     * @param null|mixed $id
     * @param string transaction id
     *
     * @throws \InvalidArgumentException
     */
    private function _validateId($id = null): void
    {
        if (empty($id)) {
            throw new \InvalidArgumentException(
                'expected transaction id to be set',
            );
        }
    }

    /**
     * generic method for validating incoming gateway responses.
     *
     * creates a new Transaction object and encapsulates
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
        if (isset($response['transaction'])) {
            // return a populated instance of Transaction
            return new Result\Successful(
                Transaction::factory($response['transaction']),
            );
        }

        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        throw new Exception\Unexpected(
            'Expected transaction or apiErrorResponse',
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
