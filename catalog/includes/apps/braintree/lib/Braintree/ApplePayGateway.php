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
 * Braintree ApplePayGateway module
 * Manages Apple Pay for Web.
 *
 * @category   Resources
 */
class ApplePayGateway
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

    public function registerDomain($domain)
    {
        $path = $this->_config->merchantPath().'/processing/apple_pay/validate_domains';
        $response = $this->_http->post($path, ['url' => $domain]);

        if (\array_key_exists('response', $response) && $response['response']['success']) {
            return new Result\Successful();
        }

        if (\array_key_exists('apiErrorResponse', $response)) {
            return new Result\Error($response['apiErrorResponse']);
        }
    }

    public function unregisterDomain($domain)
    {
        $path = $this->_config->merchantPath().'/processing/apple_pay/unregister_domain';
        $this->_http->delete($path, ['url' => $domain]);

        return new Result\Successful();
    }

    public function registeredDomains()
    {
        $path = $this->_config->merchantPath().'/processing/apple_pay/registered_domains';
        $response = $this->_http->get($path);

        if (\array_key_exists('response', $response) && \array_key_exists('domains', $response['response'])) {
            $options = ApplePayOptions::factory($response['response']);

            return new Result\Successful($options, 'applePayOptions');
        }

        if (\array_key_exists('apiErrorResponse', $response)) {
            return new Result\Error($response['apiErrorResponse']);
        }

        throw new Exception\Unexpected('expected response or apiErrorResponse');
    }
}
