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
