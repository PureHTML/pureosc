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
