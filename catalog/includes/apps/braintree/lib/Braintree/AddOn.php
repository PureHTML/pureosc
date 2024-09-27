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
