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
