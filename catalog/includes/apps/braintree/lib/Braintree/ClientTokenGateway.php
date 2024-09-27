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

use InvalidArgumentException;

class ClientTokenGateway
{
    private Gateway $_gateway;

    private Configuration $_config;

    private Http $_http;

    /**
     * @param Gateway $gateway
     */
    public function __construct($gateway)
    {
        $this->_gateway = $gateway;
        $this->_config = $gateway->config;
        $this->_config->assertHasAccessTokenOrKeys();
        $this->_http = new Http($gateway->config);
    }

    public function generate($params = [])
    {
        if (!\array_key_exists('version', $params)) {
            $params['version'] = ClientToken::DEFAULT_VERSION;
        }

        $this->conditionallyVerifyKeys($params);
        $generateParams = ['client_token' => $params];

        return $this->_doGenerate('/client_token', $generateParams);
    }

    /**
     * sends the generate request to the gateway.
     *
     * @ignore
     *
     * @param mixed $subPath
     * @param array $params
     *
     * @return string
     */
    public function _doGenerate($subPath, $params)
    {
        $fullPath = $this->_config->merchantPath().$subPath;
        $response = $this->_http->post($fullPath, $params);

        return $this->_verifyGatewayResponse($response);
    }

    /**
     * @param array $params
     *
     * @throws \InvalidArgumentException
     */
    public function conditionallyVerifyKeys($params): void
    {
        if (\array_key_exists('customerId', $params)) {
            Util::verifyKeys($this->generateWithCustomerIdSignature(), $params);
        } else {
            Util::verifyKeys($this->generateWithoutCustomerIdSignature(), $params);
        }
    }

    /**
     * @return mixed[]
     */
    public function generateWithCustomerIdSignature()
    {
        return [
            'version', 'customerId', 'proxyMerchantId',
            ['options' => ['makeDefault', 'verifyCard', 'failOnDuplicatePaymentMethod']],
            'merchantAccountId'];
    }

    /**
     * @return string[]
     */
    public function generateWithoutCustomerIdSignature()
    {
        return ['version', 'proxyMerchantId', 'merchantAccountId'];
    }

    /**
     * generic method for validating incoming gateway responses.
     *
     * If the request is successful, returns a client token string.
     * Otherwise, throws an InvalidArgumentException with the error
     * response from the Gateway or an HTTP status code exception.
     *
     * @ignore
     *
     * @param array $response gateway response values
     *
     * @throws HTTP|\InvalidArgumentException status code exception
     *
     * @return string client token
     */
    private function _verifyGatewayResponse($response)
    {
        if (isset($response['clientToken'])) {
            return $response['clientToken']['value'];
        }

        if (isset($response['apiErrorResponse'])) {
            throw new \InvalidArgumentException(
                $response['apiErrorResponse']['message'],
            );
        }

        throw new Exception\Unexpected(
            'Expected clientToken or apiErrorResponse',
        );
    }
}
