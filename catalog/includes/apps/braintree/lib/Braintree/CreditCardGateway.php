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
 * Braintree CreditCardGateway module
 * Creates and manages Braintree CreditCards.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on CreditCards, see {@link https://developers.braintreepayments.com/reference/response/credit-card/php https://developers.braintreepayments.com/reference/response/credit-card/php}<br />
 * For more detailed information on CreditCard verifications, see {@link https://developers.braintreepayments.com/reference/response/credit-card-verification/php https://developers.braintreepayments.com/reference/response/credit-card-verification/php}
 *
 * @category   Resources
 */
class CreditCardGateway
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

    public function create($attribs)
    {
        Util::verifyKeys(self::createSignature(), $attribs);
        $this->_checkForDeprecatedAttributes($attribs);

        return $this->_doCreate('/payment_methods', ['credit_card' => $attribs]);
    }

    /**
     * attempts the create operation assuming all data will validate
     * returns a CreditCard object instead of a Result.
     *
     * @param array $attribs
     *
     * @throws Exception\ValidationError
     *
     * @return CreditCard
     */
    public function createNoValidate($attribs)
    {
        $result = $this->create($attribs);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
    }
    /**
     * returns a ResourceCollection of expired credit cards.
     *
     * @return ResourceCollection
     */
    public function expired()
    {
        $path = $this->_config->merchantPath().'/payment_methods/all/expired_ids';
        $response = $this->_http->post($path);
        $pager = [
            'object' => $this,
            'method' => 'fetchExpired',
            'methodArgs' => [],
        ];

        return new ResourceCollection($response, $pager);
    }

    public function fetchExpired($ids)
    {
        $path = $this->_config->merchantPath().'/payment_methods/all/expired';
        $response = $this->_http->post($path, ['search' => ['ids' => $ids]]);

        return Util::extractattributeasarray(
            $response['paymentMethods'],
            'creditCard',
        );
    }
    /**
     * returns a ResourceCollection of credit cards expiring between start/end.
     *
     * @param mixed $startDate
     * @param mixed $endDate
     *
     * @return ResourceCollection
     */
    public function expiringBetween($startDate, $endDate)
    {
        $queryPath = $this->_config->merchantPath().'/payment_methods/all/expiring_ids?start='.date('mY', $startDate).'&end='.date('mY', $endDate);
        $response = $this->_http->post($queryPath);
        $pager = [
            'object' => $this,
            'method' => 'fetchExpiring',
            'methodArgs' => [$startDate, $endDate],
        ];

        return new ResourceCollection($response, $pager);
    }

    public function fetchExpiring($startDate, $endDate, $ids)
    {
        $queryPath = $this->_config->merchantPath().'/payment_methods/all/expiring?start='.date('mY', $startDate).'&end='.date('mY', $endDate);
        $response = $this->_http->post($queryPath, ['search' => ['ids' => $ids]]);

        return Util::extractAttributeAsArray(
            $response['paymentMethods'],
            'creditCard',
        );
    }

    /**
     * find a creditcard by token.
     *
     * @param string $token credit card unique id
     *
     * @throws Exception\NotFound
     *
     * @return CreditCard
     */
    public function find($token)
    {
        $this->_validateId($token);

        try {
            $path = $this->_config->merchantPath().'/payment_methods/credit_card/'.$token;
            $response = $this->_http->get($path);

            return CreditCard::factory($response['creditCard']);
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound(
                'credit card with token '.$token.' not found',
            );
        }
    }

    /**
     * Convert a payment method nonce to a credit card.
     *
     * @param string $nonce payment method nonce
     *
     * @throws Exception\NotFound
     *
     * @return CreditCard
     */
    public function fromNonce($nonce)
    {
        $this->_validateId($nonce, 'nonce');

        try {
            $path = $this->_config->merchantPath().'/payment_methods/from_nonce/'.$nonce;
            $response = $this->_http->get($path);

            return CreditCard::factory($response['creditCard']);
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound(
                'credit card with nonce '.$nonce.' locked, consumed or not found',
            );
        }
    }

    /**
     * create a credit on the card for the passed transaction.
     *
     * @param mixed $token
     * @param mixed $transactionAttribs
     *
     * @return Result\Error|Result\Successful
     */
    public function credit($token, $transactionAttribs)
    {
        $this->_validateId($token);

        return Transaction::credit(
            array_merge(
                $transactionAttribs,
                ['paymentMethodToken' => $token],
            ),
        );
    }

    /**
     * create a credit on this card, assuming validations will pass.
     *
     * returns a Transaction object on success
     *
     * @param mixed $token
     * @param mixed $transactionAttribs
     *
     * @throws Exception\ValidationError
     *
     * @return Transaction
     */
    public function creditNoValidate($token, $transactionAttribs)
    {
        $result = $this->credit($token, $transactionAttribs);

        return Util::returnObjectOrThrowException('Braintree\Transaction', $result);
    }

    /**
     * create a new sale for the current card.
     *
     * @param string $token
     * @param array  $transactionAttribs
     *
     * @return Result\Error|Result\Successful
     *
     * @see Transaction::sale()
     */
    public function sale($token, $transactionAttribs)
    {
        $this->_validateId($token);

        return Transaction::sale(
            array_merge(
                $transactionAttribs,
                ['paymentMethodToken' => $token],
            ),
        );
    }

    /**
     * create a new sale using this card, assuming validations will pass.
     *
     * returns a Transaction object on success
     *
     * @param string $token
     * @param array  $transactionAttribs
     *
     * @throws Exception\ValidationsFailed
     *
     * @return Transaction
     *
     * @see Transaction::sale()
     */
    public function saleNoValidate($token, $transactionAttribs)
    {
        $result = $this->sale($token, $transactionAttribs);

        return Util::returnObjectOrThrowException('Braintree\Transaction', $result);
    }

    /**
     * updates the creditcard record.
     *
     * if calling this method in context, $token
     * is the 2nd attribute. $token is not sent in object context.
     *
     * @param string $token      (optional)
     * @param array  $attributes (Note: $deviceSessionId and $fraudMerchantId params are deprecated. Use $deviceData instead)
     *
     * @return Result\Error|Result\Successful
     */
    public function update($token, $attributes)
    {
        Util::verifyKeys(self::updateSignature(), $attributes);
        $this->_validateId($token);
        $this->_checkForDeprecatedAttributes($attributes);

        return $this->_doUpdate('put', '/payment_methods/credit_card/'.$token, ['creditCard' => $attributes]);
    }

    /**
     * update a creditcard record, assuming validations will pass.
     *
     * if calling this method in context, $token
     * is the 2nd attribute. $token is not sent in object context.
     * returns a CreditCard object on success
     *
     * @param string $token
     * @param array  $attributes
     *
     * @throws Exception\ValidationsFailed
     *
     * @return CreditCard
     */
    public function updateNoValidate($token, $attributes)
    {
        $result = $this->update($token, $attributes);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
    }

    public function delete($token)
    {
        $this->_validateId($token);
        $path = $this->_config->merchantPath().'/payment_methods/credit_card/'.$token;
        $this->_http->delete($path);

        return new Result\Successful();
    }

    public static function billingAddressSignature()
    {
        return [
            'firstName',
            'lastName',
            'company',
            'countryCodeAlpha2',
            'countryCodeAlpha3',
            'countryCodeNumeric',
            'countryName',
            'extendedAddress',
            'locality',
            'region',
            'postalCode',
            'streetAddress',
        ];
    }

    public static function createSignature()
    {
        $options = self::baseOptions();
        $options[] = 'failOnDuplicatePaymentMethod';
        $signature = self::baseSignature($options);
        $signature[] = 'customerId';
        $signature[] = self::threeDSecurePassThruSignature();

        return $signature;
    }

    public static function threeDSecurePassThruSignature()
    {
        return [
            'threeDSecurePassThru' => [
                'eciFlag',
                'cavv',
                'xid',
                'threeDSecureVersion',
                'authenticationResponse',
                'directoryResponse',
                'cavvAlgorithm',
                'dsTransactionId',
            ],
        ];
    }

    public static function updateSignature()
    {
        $options = self::baseOptions();
        $options[] = 'failOnDuplicatePaymentMethod';
        $signature = self::baseSignature($options);
        $signature[] = self::threeDSecurePassThruSignature();

        $updateExistingBillingSignature = [
            [
                'options' => [
                    'updateExisting',
                ],
            ],
        ];

        foreach ($signature as $key => $value) {
            if (\is_array($value) && \array_key_exists('billingAddress', $value)) {
                $signature[$key]['billingAddress'] = array_merge_recursive($value['billingAddress'], $updateExistingBillingSignature);
            }
        }

        return $signature;
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

    private static function baseOptions()
    {
        return ['makeDefault', 'verificationMerchantAccountId', 'verifyCard', 'verificationAmount', 'verificationAccountType', 'venmoSdkSession'];
    }

    private static function baseSignature($options)
    {
        return [
            'billingAddressId', 'cardholderName', 'cvv', 'number',
            'expirationDate', 'expirationMonth', 'expirationYear', 'token', 'venmoSdkPaymentMethodCode',
            'deviceData', 'paymentMethodNonce',
            'deviceSessionId', 'fraudMerchantId', // NEXT_MAJOR_VERSION remove deviceSessionId and fraudMerchantId
            ['options' => $options],
            [
                'billingAddress' => self::billingAddressSignature(),
            ],
        ];
    }

    /**
     * verifies that a valid credit card identifier is being used.
     *
     * @ignore
     *
     * @param string $identifier
     * @param mixed  $identifierType
     *
     * @throws \InvalidArgumentException
     */
    private function _validateId($identifier = null, $identifierType = 'token'): void
    {
        if (empty($identifier)) {
            throw new \InvalidArgumentException(
                'expected credit card id to be set',
            );
        }

        if (!preg_match('/^[0-9A-Za-z_-]+$/', $identifier)) {
            throw new \InvalidArgumentException(
                $identifier.' is an invalid credit card '.$identifierType.'.',
            );
        }
    }

    /**
     * sends the update request to the gateway.
     *
     * @ignore
     *
     * @param mixed $httpVerb
     * @param mixed $subPath
     * @param array $params
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
     * creates a new CreditCard object and encapsulates
     * it inside a Result\Successful object, or
     * encapsulates a Errors object inside a Result\Error
     * alternatively, throws an Unexpected exception if the response is invalid
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
        if (isset($response['creditCard'])) {
            // return a populated instance of Address
            return new Result\Successful(
                CreditCard::factory($response['creditCard']),
            );
        }

        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        throw new Exception\Unexpected(
            'Expected address or apiErrorResponse',
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
