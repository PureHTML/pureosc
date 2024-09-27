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
 * Shipping methods module
 * Shipping methods can be assigned to shipping addresses when
 * creating transactions.
 */
class ShippingMethod
{
    public const SAME_DAY = 'same_day';
    public const NEXT_DAY = 'next_day';
    public const PRIORITY = 'priority';
    public const GROUND = 'ground';
    public const ELECTRONIC = 'electronic';
    public const SHIP_TO_STORE = 'ship_to_store';
}
