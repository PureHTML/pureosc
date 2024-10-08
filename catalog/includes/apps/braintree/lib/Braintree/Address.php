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
 * Braintree Address module
 * Creates and manages Braintree Addresses.
 *
 * An Address belongs to a Customer. It can be associated to a
 * CreditCard as the billing address. It can also be used
 * as the shipping address when creating a Transaction.
 *
 * @property string    $company
 * @property string    $countryName
 * @property \DateTime $createdAt
 * @property string    $customerId
 * @property string    $extendedAddress
 * @property string    $firstName
 * @property string    $id
 * @property string    $lastName
 * @property string    $locality
 * @property string    $phoneNumber
 * @property string    $postalCode
 * @property string    $region
 * @property string    $streetAddress
 * @property \DateTime $updatedAt
 */
class Address extends Base
{
    /**
     * create a printable representation of the object as:
     * ClassName[property=value, property=value]
     *
     * @ignore
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__.'['.
                Util::attributesToString($this->_attributes).']';
    }
    /**
     * returns false if comparing object is not a Address,
     * or is a Address with a different id.
     *
     * @param object $other address to compare against
     *
     * @return bool
     */
    public function isEqual($other)
    {
        return !($other instanceof self) ?
            false :
            ($this->id === $other->id && $this->customerId === $other->customerId);
    }

    /**
     *  factory method: returns an instance of Address
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return Address
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    // static methods redirecting to gateway

    /**
     * @param array $attribs
     *
     * @return Address
     */
    public static function create($attribs)
    {
        return Configuration::gateway()->address()->create($attribs);
    }

    /**
     * @param array $attribs
     *
     * @return Address
     */
    public static function createNoValidate($attribs)
    {
        return Configuration::gateway()->address()->createNoValidate($attribs);
    }

    /**
     * @param Customer|int $customerOrId
     * @param int          $addressId
     *
     * @throws InvalidArgumentException
     *
     * @return Result\Successful
     */
    public static function delete($customerOrId = null, $addressId = null)
    {
        return Configuration::gateway()->address()->delete($customerOrId, $addressId);
    }

    /**
     * @param Customer|int $customerOrId
     * @param int          $addressId
     *
     * @throws Exception\NotFound
     *
     * @return Address
     */
    public static function find($customerOrId, $addressId)
    {
        return Configuration::gateway()->address()->find($customerOrId, $addressId);
    }

    /**
     * @param Customer|int $customerOrId
     * @param int          $addressId
     * @param array        $attributes
     *
     * @throws Exception\Unexpected
     *
     * @return Result\Error|Result\Successful
     */
    public static function update($customerOrId, $addressId, $attributes)
    {
        return Configuration::gateway()->address()->update($customerOrId, $addressId, $attributes);
    }

    public static function updateNoValidate($customerOrId, $addressId, $attributes)
    {
        return Configuration::gateway()->address()->updateNoValidate($customerOrId, $addressId, $attributes);
    }

    /**
     * sets instance properties from an array of values.
     *
     * @ignore
     *
     * @param array $addressAttribs array of address data
     */
    protected function _initialize($addressAttribs): void
    {
        // set the attributes
        $this->_attributes = $addressAttribs;
    }
}
