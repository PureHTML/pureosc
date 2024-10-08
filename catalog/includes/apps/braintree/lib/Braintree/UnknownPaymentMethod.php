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
 * Braintree UnknownPaymentMethod module.
 *
 * @category   Resources
 */

/**
 * Manages Braintree UnknownPaymentMethod.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 *
 * @property string $imageUrl
 * @property string $token
 */
class UnknownPaymentMethod extends Base
{
    /**
     *  factory method: returns an instance of UnknownPaymentMethod
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return UnknownPaymentMethod
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $values = array_values($attributes);
        $instance->_initialize(array_shift($values));

        return $instance;
    }

    /* instance methods */

    /**
     * returns false if default is null or false.
     *
     * @return bool
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * sets instance properties from an array of values.
     *
     * @param array $unknownPaymentMethodAttribs array of unknownPaymentMethod data
     */
    protected function _initialize($unknownPaymentMethodAttribs): void
    {
        // set the attributes
        $this->imageUrl = 'https://assets.braintreegateway.com/payment_method_logo/unknown.png';
        $this->_attributes = $unknownPaymentMethodAttribs;
    }
}
