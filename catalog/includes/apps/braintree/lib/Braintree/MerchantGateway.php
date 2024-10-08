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

class MerchantGateway
{
    private $_gateway;
    private $_config;
    private $_http;

    public function __construct($gateway)
    {
        $this->_gateway = $gateway;
        $this->_config = $gateway->config;
        $this->_config->assertHasClientCredentials();
        $this->_http = new Http($gateway->config);
        $this->_http->useClientCredentials();
    }

    public function create($attribs)
    {
        $response = $this->_http->post('/merchants/create_via_api', ['merchant' => $attribs]);

        return $this->_verifyGatewayResponse($response);
    }

    private function _verifyGatewayResponse($response)
    {
        if (isset($response['response']['merchant'])) {
            // return a populated instance of merchant
            return new Result\Successful([
                Merchant::factory($response['response']['merchant']),
                OAuthCredentials::factory($response['response']['credentials']),
            ]);
        }

        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        throw new Exception\Unexpected(
            'Expected merchant or apiErrorResponse',
        );
    }
}
