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
 * Braintree TransactionLineItemGateway processor
 * Creates and manages transaction line items.
 *
 * @category   Resources
 */
class TransactionLineItemGateway
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
     * @param mixed $id
     * @param string id
     *
     * @return Transaction
     */
    public function findAll($id)
    {
        $this->_validateId($id);

        try {
            $path = $this->_config->merchantPath().'/transactions/'.$id.'/line_items';
            $response = $this->_http->get($path);

            $lineItems = [];

            if (isset($response['lineItems'])) {
                foreach ($response['lineItems'] as $lineItem) {
                    $lineItems[] = new TransactionLineItem($lineItem);
                }
            }

            return $lineItems;
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound('transaction line items with id '.$id.' not found');
        }
    }

    /**
     * verifies that a valid transaction id is being used.
     *
     * @ignore
     *
     * @param null|mixed $id
     * @param string transaction id
     *
     * @throws \InvalidArgumentException
     */
    private function _validateId($id = null): void
    {
        if (empty($id)) {
            throw new \InvalidArgumentException('expected transaction id to be set');
        }

        if (!preg_match('/^[0-9a-z]+$/', $id)) {
            throw new \InvalidArgumentException($id.' is an invalid transaction id.');
        }
    }
}
