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
class AddOn extends Modification
{
    /**
     * @param array $attributes
     *
     * @return AddOn
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    /**
     * static methods redirecting to gateway.
     *
     * @return AddOn[]
     */
    public static function all()
    {
        return Configuration::gateway()->addOn()->all();
    }
}
