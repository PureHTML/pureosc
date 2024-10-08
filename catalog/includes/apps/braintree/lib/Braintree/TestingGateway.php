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

class TestingGateway
{
    private $_gateway;
    private $_config;
    private $_http;

    public function __construct($gateway)
    {
        $this->_gateway = $gateway;
        $this->_config = $gateway->config;
        $this->_http = new Http($this->_config);
    }

    public function settle($transactionId)
    {
        return self::_doTestRequest('/settle', $transactionId);
    }

    public function settlementPending($transactionId)
    {
        return self::_doTestRequest('/settlement_pending', $transactionId);
    }

    public function settlementConfirm($transactionId)
    {
        return self::_doTestRequest('/settlement_confirm', $transactionId);
    }

    public function settlementDecline($transactionId)
    {
        return self::_doTestRequest('/settlement_decline', $transactionId);
    }

    private function _doTestRequest($testPath, $transactionId)
    {
        self::_checkEnvironment();
        $path = $this->_config->merchantPath().'/transactions/'.$transactionId.$testPath;
        $response = $this->_http->put($path);

        return Transaction::factory($response['transaction']);
    }

    private function _checkEnvironment(): void
    {
        if (Configuration::$global->getEnvironment() === 'production') {
            throw new Exception\TestOperationPerformedInProduction();
        }
    }
}
