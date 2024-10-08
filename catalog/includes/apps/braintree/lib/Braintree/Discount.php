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
 * @property string      $amount
 * @property \DateTime   $createdAt
 * @property null|int    $currentBillingCycle
 * @property string      $description
 * @property string      $id
 * @property null|string $kind
 * @property string      $merchantId
 * @property string      $name
 * @property bool        $neverExpires
 * @property null|int    $numberOfBillingCycles
 * @property null|int    $quantity
 * @property \DateTime   $updatedAt
 */
class Discount extends Modification
{
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    // static methods redirecting to gateway

    public static function all()
    {
        return Configuration::gateway()->discount()->all();
    }
}
