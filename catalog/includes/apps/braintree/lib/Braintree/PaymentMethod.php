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
