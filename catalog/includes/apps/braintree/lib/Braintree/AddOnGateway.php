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

class AddOnGateway
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

    /**
     * @return AddOn[]
     */
    public function all()
    {
        $path = $this->_config->merchantPath().'/add_ons';
        $response = $this->_http->get($path);

        $addOns = ['addOn' => $response['addOns']];

        return Util::extractAttributeAsArray(
            $addOns,
            'addOn',
        );
    }
}
