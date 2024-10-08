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
 * Braintree PaymentMethodGateway module.
 *
 * @category   Resources
 */

/**
 * Creates and manages Braintree PaymentMethods.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 */
class PaymentMethodGateway
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

        return $this->_doCreate('/payment_methods', ['payment_method' => $attribs]);
    }

    /**
     * find a PaymentMethod by token.
     *
     * @param string $token payment method unique id
     *
     * @throws Exception\NotFound
     *
     * @return CreditCard|PayPalAccount
     */
    public function find($token)
    {
        $this->_validateId($token);

        try {
            $path = $this->_config->merchantPath().'/payment_methods/any/'.$token;
            $response = $this->_http->get($path);

            return PaymentMethodParser::parsePaymentMethod($response);
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound(
                'payment method with token '.$token.' not found',
            );
        }
    }

    public function update($token, $attribs)
    {
        Util::verifyKeys(self::updateSignature(), $attribs);
        $this->_checkForDeprecatedAttributes($attribs);

        return $this->_doUpdate('/payment_methods/any/'.$token, ['payment_method' => $attribs]);
    }

    public function delete($token, $options = [])
    {
        Util::verifyKeys(self::deleteSignature(), $options);
        $this->_validateId($token);
        $queryString = '';

        if (!empty($options)) {
            $queryString = '?'.http_build_query(Util::camelCaseToDelimiterArray($options, '_'));
        }

        return $this->_doDelete('/payment_methods/any/'.$token.$queryString);
    }

    public function grant($sharedPaymentMethodToken, $attribs = [])
    {
        if (\is_bool($attribs) === true) {
            $attribs = ['allow_vaulting' => $attribs];
        }

        $options = ['shared_payment_method_token' => $sharedPaymentMethodToken];

        return $this->_doGrant(
            '/payment_methods/grant',
            [
                'payment_method' => array_merge($attribs, $options),
            ],
        );
    }

    public function revoke($sharedPaymentMethodToken)
    {
        return $this->_doRevoke(
            '/payment_methods/revoke',
            [
                'payment_method' => [
                    'shared_payment_method_token' => $sharedPaymentMethodToken,
                ],
            ],
        );
    }

    public static function createSignature()
    {
        return array_merge(self::baseSignature(), [
            'customerId',
            'paypalRefreshToken',
            CreditCardGateway::threeDSecurePassThruSignature(),
        ]);
    }

    public static function updateSignature()
    {
        $billingAddressSignature = AddressGateway::updateSignature();
        $billingAddressSignature[] = [
            'options' => [
                'updateExisting',
            ],
        ];
        $threeDSPassThruSignature = [
            'authenticationResponse',
            'cavv',
            'cavvAlgorithm',
            'directoryResponse',
            'dsTransactionId',
            'eciFlag',
            'threeDSecureVersion',
            'xid',
        ];

        return array_merge(self::baseSignature(), [
            'venmoSdkPaymentMethodCode',
            'deviceSessionId', 'fraudMerchantId', // NEXT_MAJOR_VERSION remove deviceSessionId and fraudMerchantId
            ['billingAddress' => $billingAddressSignature],
            ['threeDSecurePassThru' => $threeDSPassThruSignature],
        ]);
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

    public function _doGrant($subPath, $params)
    {
        $fullPath = $this->_config->merchantPath().$subPath;
        $response = $this->_http->post($fullPath, $params);

        return $this->_verifyGrantResponse($response);
    }

    public function _doRevoke($subPath, $params)
    {
        $fullPath = $this->_config->merchantPath().$subPath;
        $response = $this->_http->post($fullPath, $params);

        return $this->_verifyRevokeResponse($response);
    }

    /**
     * sends the update request to the gateway.
     *
     * @ignore
     *
     * @param string $subPath
     * @param array  $params
     *
     * @return mixed
     */
    public function _doUpdate($subPath, $params)
    {
        $fullPath = $this->_config->merchantPath().$subPath;
        $response = $this->_http->put($fullPath, $params);

        return $this->_verifyGatewayResponse($response);
    }

    /**
     * sends the delete request to the gateway.
     *
     * @ignore
     *
     * @param string $subPath
     *
     * @return mixed
     */
    public function _doDelete($subPath)
    {
        $fullPath = $this->_config->merchantPath().$subPath;
        $this->_http->delete($fullPath);

        return new Result\Successful();
    }

    private static function baseSignature()
    {
        $billingAddressSignature = AddressGateway::createSignature();
        $optionsSignature = [
            'failOnDuplicatePaymentMethod',
            'makeDefault',
            'verificationMerchantAccountId',
            'verifyCard',
            'verificationAccountType',
            'verificationAmount',
            'usBankAccountVerificationMethod',
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
        ];

        return [
            'billingAddressId',
            'cardholderName',
            'cvv',
            'deviceData',
            'expirationDate',
            'expirationMonth',
            'expirationYear',
            'number',
            'paymentMethodNonce',
            'token',
            ['options' => $optionsSignature],
            ['billingAddress' => $billingAddressSignature],
        ];
    }

    private static function deleteSignature()
    {
        return ['revokeAllGrants'];
    }

    /**
     * generic method for validating incoming gateway responses.
     *
     * creates a new CreditCard or PayPalAccount object
     * and encapsulates it inside a Result\Successful object, or
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
        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        if ($response) {
            return new Result\Successful(
                PaymentMethodParser::parsePaymentMethod($response),
                'paymentMethod',
            );
        }

        throw new Exception\Unexpected(
            'Expected payment method or apiErrorResponse',
        );
    }

    private function _verifyGrantResponse($response)
    {
        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        if (isset($response['paymentMethodNonce'])) {
            return new Result\Successful(
                PaymentMethodNonce::factory($response['paymentMethodNonce']),
                'paymentMethodNonce',
            );
        }

        throw new Exception\Unexpected(
            'Expected paymentMethodNonce or apiErrorResponse',
        );
    }

    private function _verifyRevokeResponse($response)
    {
        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        if (isset($response['success'])) {
            return new Result\Successful();
        }

        throw new Exception\Unexpected(
            'Expected success or apiErrorResponse',
        );
    }

    /**
     * verifies that a valid payment method identifier is being used.
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
                'expected payment method id to be set',
            );
        }

        if (!preg_match('/^[0-9A-Za-z_-]+$/', $identifier)) {
            throw new \InvalidArgumentException(
                $identifier.' is an invalid payment method '.$identifierType.'.',
            );
        }
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
