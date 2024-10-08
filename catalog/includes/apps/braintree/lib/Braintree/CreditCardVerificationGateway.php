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

class CreditCardVerificationGateway
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

    public function create($attributes)
    {
        $response = $this->_http->post($this->_config->merchantPath().'/verifications', ['verification' => $attributes]);

        return $this->_verifyGatewayResponse($response);
    }

    public function fetch($query, $ids)
    {
        $criteria = [];

        foreach ($query as $term) {
            $criteria[$term->name] = $term->toparam();
        }

        $criteria['ids'] = CreditCardVerificationSearch::ids()->in($ids)->toparam();
        $path = $this->_config->merchantPath().'/verifications/advanced_search';
        $response = $this->_http->post($path, ['search' => $criteria]);

        return Util::extractattributeasarray(
            $response['creditCardVerifications'],
            'verification',
        );
    }

    public function search($query)
    {
        $criteria = [];

        foreach ($query as $term) {
            $criteria[$term->name] = $term->toparam();
        }

        $path = $this->_config->merchantPath().'/verifications/advanced_search_ids';
        $response = $this->_http->post($path, ['search' => $criteria]);
        $pager = [
            'object' => $this,
            'method' => 'fetch',
            'methodArgs' => [$query],
        ];

        return new ResourceCollection($response, $pager);
    }

    private function _verifyGatewayResponse($response)
    {
        if (isset($response['verification'])) {
            return new Result\Successful(
                CreditCardVerification::factory($response['verification']),
            );
        }

        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        throw new Exception\Unexpected(
            'Expected transaction or apiErrorResponse',
        );
    }
}
