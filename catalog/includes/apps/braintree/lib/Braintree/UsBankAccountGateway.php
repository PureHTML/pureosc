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
 * Braintree UsBankAccountGateway module.
 *
 * @category   Resources
 */

/**
 * Manages Braintree UsBankAccounts.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 */
class UsBankAccountGateway
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

    /**
     * find a usBankAccount by token.
     *
     * @param string $token paypal accountunique id
     *
     * @throws Exception\NotFound
     *
     * @return UsBankAccount
     */
    public function find($token)
    {
        try {
            $path = $this->_config->merchantPath().'/payment_methods/us_bank_account/'.$token;
            $response = $this->_http->get($path);

            return UsBankAccount::factory($response['usBankAccount']);
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound(
                'US bank account with token '.$token.' not found',
            );
        }
    }

    /**
     * create a new sale for the current UsBank account.
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
        return Transaction::sale(
            array_merge(
                $transactionAttribs,
                ['paymentMethodToken' => $token],
            ),
        );
    }

    /**
     * generic method for validating incoming gateway responses.
     *
     * creates a new UsBankAccount object and encapsulates
     * it inside a Result\Successful object, or
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
        if (isset($response['usBankAccount'])) {
            // return a populated instance of UsBankAccount
            return new Result\Successful(
                UsBankAccount::factory($response['usBankAccount']),
            );
        }

        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        throw new Exception\Unexpected(
            'Expected US bank account or apiErrorResponse',
        );
    }
}
