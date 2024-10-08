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

/**
 * Braintree AddressGateway module
 * Creates and manages Braintree Addresses.
 *
 * An Address belongs to a Customer. It can be associated to a
 * CreditCard as the billing address. It can also be used
 * as the shipping address when creating a Transaction.
 */
class AddressGateway
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

    /* public class methods */
    /**
     * @param array $attribs
     *
     * @return Result\Error|Result\Successful
     */
    public function create($attribs)
    {
        Util::verifyKeys(self::createSignature(), $attribs);
        $customerId = $attribs['customerId'] ??
            null;

        $this->_validateCustomerId($customerId);
        unset($attribs['customerId']);

        try {
            return $this->_doCreate(
                '/customers/'.$customerId.'/addresses',
                ['address' => $attribs],
            );
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound(
                'Customer '.$customerId.' not found.',
            );
        }
    }

    /**
     * attempts the create operation assuming all data will validate
     * returns a Address object instead of a Result.
     *
     * @param array $attribs
     *
     * @throws Exception\ValidationError
     *
     * @return self
     */
    public function createNoValidate($attribs)
    {
        $result = $this->create($attribs);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
    }

    /**
     * delete an address by id.
     *
     * @param mixed  $customerOrId
     * @param string $addressId
     */
    public function delete($customerOrId = null, $addressId = null)
    {
        $this->_validateId($addressId);
        $customerId = $this->_determineCustomerId($customerOrId);
        $path = $this->_config->merchantPath().'/customers/'.$customerId.'/addresses/'.$addressId;
        $this->_http->delete($path);

        return new Result\Successful();
    }

    /**
     * find an address by id.
     *
     * Finds the address with the given <b>addressId</b> that is associated
     * to the given <b>customerOrId</b>.
     * If the address cannot be found, a NotFound exception will be thrown.
     *
     * @param mixed  $customerOrId
     * @param string $addressId
     *
     * @throws Exception\NotFound
     *
     * @return Address
     */
    public function find($customerOrId, $addressId)
    {
        $customerId = $this->_determineCustomerId($customerOrId);
        $this->_validateId($addressId);

        try {
            $path = $this->_config->merchantPath().'/customers/'.$customerId.'/addresses/'.$addressId;
            $response = $this->_http->get($path);

            return Address::factory($response['address']);
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound(
                'address for customer '.$customerId.
                ' with id '.$addressId.' not found.',
            );
        }
    }

    /**
     * updates the address record.
     *
     * if calling this method in context,
     * customerOrId is the 2nd attribute, addressId 3rd.
     * customerOrId & addressId are not sent in object context.
     *
     * @param mixed  $customerOrId (only used in call)
     * @param string $addressId    (only used in call)
     * @param array  $attributes
     *
     * @return Result\Error|Result\Successful
     */
    public function update($customerOrId, $addressId, $attributes)
    {
        $this->_validateId($addressId);
        $customerId = $this->_determineCustomerId($customerOrId);
        Util::verifyKeys(self::updateSignature(), $attributes);

        $path = $this->_config->merchantPath().'/customers/'.$customerId.'/addresses/'.$addressId;
        $response = $this->_http->put($path, ['address' => $attributes]);

        return $this->_verifyGatewayResponse($response);
    }

    /**
     * update an address record, assuming validations will pass.
     *
     * if calling this method in context,
     * customerOrId is the 2nd attribute, addressId 3rd.
     * customerOrId & addressId are not sent in object context.
     *
     * @param mixed $customerOrId
     * @param mixed $addressId
     * @param mixed $attributes
     *
     * @throws Exception\ValidationsFailed
     *
     * @return Transaction
     *
     * @see Address::update()
     */
    public function updateNoValidate($customerOrId, $addressId, $attributes)
    {
        $result = $this->update($customerOrId, $addressId, $attributes);

        return Util::returnObjectOrThrowException(__CLASS__, $result);
    }

    /**
     * creates a full array signature of a valid create request.
     *
     * @return array gateway create request format
     */
    public static function createSignature()
    {
        return [
            'company', 'countryCodeAlpha2', 'countryCodeAlpha3', 'countryCodeNumeric',
            'countryName', 'customerId', 'extendedAddress', 'firstName',
            'lastName', 'locality', 'postalCode', 'region', 'streetAddress',
        ];
    }

    /**
     * creates a full array signature of a valid update request.
     *
     * @return array gateway update request format
     */
    public static function updateSignature()
    {
        return self::createSignature();
    }

    /**
     * verifies that a valid address id is being used.
     *
     * @ignore
     *
     * @param string $id address id
     *
     * @throws \InvalidArgumentException
     */
    private function _validateId($id = null): void
    {
        if (empty($id) || trim($id) === '') {
            throw new \InvalidArgumentException(
                'expected address id to be set',
            );
        }

        if (!preg_match('/^[0-9A-Za-z_-]+$/', $id)) {
            throw new \InvalidArgumentException(
                $id.' is an invalid address id.',
            );
        }
    }

    /**
     * verifies that a valid customer id is being used.
     *
     * @ignore
     *
     * @param string $id customer id
     *
     * @throws \InvalidArgumentException
     */
    private function _validateCustomerId($id = null): void
    {
        if (empty($id) || trim($id) === '') {
            throw new \InvalidArgumentException(
                'expected customer id to be set',
            );
        }

        if (!preg_match('/^[0-9A-Za-z_-]+$/', $id)) {
            throw new \InvalidArgumentException(
                $id.' is an invalid customer id.',
            );
        }
    }

    /**
     * determines if a string id or Customer object was passed.
     *
     * @ignore
     *
     * @param mixed $customerOrId
     *
     * @return string customerId
     */
    private function _determineCustomerId($customerOrId)
    {
        $customerId = ($customerOrId instanceof Customer) ? $customerOrId->id : $customerOrId;
        $this->_validateCustomerId($customerId);

        return $customerId;
    }

    /* private class methods */
    /**
     * sends the create request to the gateway.
     *
     * @ignore
     *
     * @param string $subPath
     * @param array  $params
     *
     * @return Result\Error|Result\Successful
     */
    private function _doCreate($subPath, $params)
    {
        $fullPath = $this->_config->merchantPath().$subPath;
        $response = $this->_http->post($fullPath, $params);

        return $this->_verifyGatewayResponse($response);
    }

    /**
     * generic method for validating incoming gateway responses.
     *
     * creates a new Address object and encapsulates
     * it inside a Result\Successful object, or
     * encapsulates an Errors object inside a Result\Error
     * alternatively, throws an Unexpected exception if the response is invalid
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
        if (isset($response['address'])) {
            // return a populated instance of Address
            return new Result\Successful(
                Address::factory($response['address']),
            );
        }

        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        throw new Exception\Unexpected(
            'Expected address or apiErrorResponse',
        );
    }
}
