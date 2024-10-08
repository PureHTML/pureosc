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

class ClientToken
{
    public const DEFAULT_VERSION = 2;

    // static methods redirecting to gateway

    /**
     * @param array $params
     *
     * @return string
     */
    public static function generate($params = [])
    {
        return Configuration::gateway()->clientToken()->generate($params);
    }

    /**
     * @param type $params
     *
     * @throws InvalidArgumentException
     */
    public static function conditionallyVerifyKeys($params)
    {
        return Configuration::gateway()->clientToken()->conditionallyVerifyKeys($params);
    }

    /**
     * @return string client token retrieved from server
     */
    public static function generateWithCustomerIdSignature()
    {
        return Configuration::gateway()->clientToken()->generateWithCustomerIdSignature();
    }

    /**
     * @return string client token retrieved from server
     */
    public static function generateWithoutCustomerIdSignature()
    {
        return Configuration::gateway()->clientToken()->generateWithoutCustomerIdSignature();
    }
}
