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
 * Braintree RevokedPaymentMethodMetadata module.
 *
 * @category   Resources
 */

/**
 * Manages Braintree RevokedPaymentMethodMetadata.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 *
 * @property string $customerId
 * @property string $revokedPaymentMethod
 * @property string $token
 */
class RevokedPaymentMethodMetadata extends Base
{
    /**
     * create a printable representation of the object as:
     * ClassName[property=value, property=value]
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__.'['.
                Util::attributesToString($this->_attributes).']';
    }
    /**
     *  factory method: returns an instance of RevokedPaymentMethodMetadata
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return RevokedPaymentMethodMetadata
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->revokedPaymentMethod = PaymentMethodParser::parsePaymentMethod($attributes);
        $instance->customerId = $instance->revokedPaymentMethod->customerId;
        $instance->token = $instance->revokedPaymentMethod->token;

        return $instance;
    }
}
