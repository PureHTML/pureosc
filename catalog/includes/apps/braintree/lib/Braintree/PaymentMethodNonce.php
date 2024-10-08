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
 * Braintree PaymentMethodNonce module.
 *
 * @category   Resources
 */

/**
 * Creates and manages Braintree PaymentMethodNonces.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 *
 * @property \Braintree\BinData          $binData
 * @property bool                        $default
 * @property string                      $nonce
 * @property \Braintree\ThreeDSecureInfo $threeDSecureInfo
 * @property string                      $type
 */
class PaymentMethodNonce extends Base
{
    // static methods redirecting to gateway

    public static function create($token, $params = [])
    {
        return Configuration::gateway()->paymentMethodNonce()->create($token, $params);
    }

    public static function find($nonce)
    {
        return Configuration::gateway()->paymentMethodNonce()->find($nonce);
    }

    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    protected function _initialize($nonceAttributes): void
    {
        $this->_attributes = $nonceAttributes;
        $this->_set('nonce', $nonceAttributes['nonce']);
        $this->_set('type', $nonceAttributes['type']);

        if (isset($nonceAttributes['authenticationInsight'])) {
            $this->_set('authenticationInsight', $nonceAttributes['authenticationInsight']);
        }

        if (isset($nonceAttributes['binData'])) {
            $this->_set('binData', BinData::factory($nonceAttributes['binData']));
        }

        if (isset($nonceAttributes['threeDSecureInfo'])) {
            $this->_set('threeDSecureInfo', ThreeDSecureInfo::factory($nonceAttributes['threeDSecureInfo']));
        }
    }
}
