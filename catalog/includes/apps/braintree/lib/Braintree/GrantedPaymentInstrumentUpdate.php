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
 * Braintree GrantedPaymentInstrumentUpdate module.
 *
 * @category   Resources
 */

/**
 * Manages Braintree GrantedPaymentInstrumentUpdate.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 *
 * @property string $grantOwnerMerchantId
 * @property string $grantRecipientMerchantId
 * @property string $paymentMethodNonce
 * @property string $token
 * @property string $updatedFields
 */
class GrantedPaymentInstrumentUpdate extends Base
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
     *  factory method: returns an instance of GrantedPaymentInstrumentUpdate
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return GrantedPaymentInstrumentUpdate
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    /* instance methods */

    /**
     * sets instance properties from an array of values.
     *
     * @param mixed $grantedPaymentInstrumentUpdateAttribs
     */
    protected function _initialize($grantedPaymentInstrumentUpdateAttribs): void
    {
        // set the attributes
        $this->_attributes = $grantedPaymentInstrumentUpdateAttribs;

        $paymentMethodNonce = isset($grantedPaymentInstrumentUpdateAttribs['paymentMethodNonce']) ?
            self::factory($grantedPaymentInstrumentUpdateAttribs['paymentMethodNonce']) :
            null;
        $this->_set('paymentMethodNonce', $paymentMethodNonce);
    }
}
