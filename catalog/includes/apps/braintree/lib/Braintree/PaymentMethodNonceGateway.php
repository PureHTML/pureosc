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
 * Braintree PaymentMethodNonceGateway module.
 *
 * @category   Resources
 */

/**
 * Creates and manages Braintree PaymentMethodNonces.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 */
class PaymentMethodNonceGateway
{
    private $_gateway;
    private $_config;
    private $_http;

    public function __construct($gateway)
    {
        $this->_gateway = $gateway;
        $this->_config = $gateway->config;
        $this->_http = new Http($gateway->config);
    }

    public function create($token, $params = [])
    {
        $subPath = '/payment_methods/'.$token.'/nonces';
        $fullPath = $this->_config->merchantPath().$subPath;
        $schema = [[
            'paymentMethodNonce' => [
                'merchantAccountId',
                'authenticationInsight',
                ['authenticationInsightOptions' => [
                    'amount',
                    'recurringCustomerConsent',
                    'recurringMaxAmount',
                ],
                ]],
        ]];
        Util::verifyKeys($schema, $params);
        $response = $this->_http->post($fullPath, $params);

        return new Result\Successful(
            PaymentMethodNonce::factory($response['paymentMethodNonce']),
            'paymentMethodNonce',
        );
    }

    /**
     * @param mixed $nonce
     */
    public function find($nonce)
    {
        try {
            $path = $this->_config->merchantPath().'/payment_method_nonces/'.$nonce;
            $response = $this->_http->get($path);

            return PaymentMethodNonce::factory($response['paymentMethodNonce']);
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound(
                'payment method nonce with id '.$nonce.' not found',
            );
        }
    }
}
