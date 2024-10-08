<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
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
