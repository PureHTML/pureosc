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
 * Braintree PaymentMethod module.
 *
 * @category   Resources
 */

/**
 * Creates and manages Braintree PaymentMethods.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 */
class PaymentMethod extends Base
{
    // static methods redirecting to gateway

    public static function create($attribs)
    {
        return Configuration::gateway()->paymentMethod()->create($attribs);
    }

    public static function find($token)
    {
        return Configuration::gateway()->paymentMethod()->find($token);
    }

    public static function update($token, $attribs)
    {
        return Configuration::gateway()->paymentMethod()->update($token, $attribs);
    }

    public static function delete($token, $options = [])
    {
        return Configuration::gateway()->paymentMethod()->delete($token, $options);
    }
}
