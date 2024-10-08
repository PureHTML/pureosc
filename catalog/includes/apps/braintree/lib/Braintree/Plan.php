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
 * @property \Braintree\Addon[]    $addOns
 * @property null|int              $billingDayOfMonth
 * @property int                   $billingFrequency
 * @property \DateTime             $createdAt
 * @property string                $currencyIsoCode
 * @property null|string           $description
 * @property \Braintree\Discount[] $discounts
 * @property string                $id
 * @property string                $name
 * @property null|int              $numberOfBillingCycles
 * @property string                $price
 * @property null|int              $trialDuration
 * @property null|string           $trialDurationUnit
 * @property bool                  $trialPeriod
 * @property \DateTime             $updatedAt
 */
class Plan extends Base
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
        return Configuration::gateway()->plan()->all();
    }

    protected function _initialize($attributes): void
    {
        $this->_attributes = $attributes;

        $addOnArray = [];

        if (isset($attributes['addOns'])) {
            foreach ($attributes['addOns'] as $addOn) {
                $addOnArray[] = AddOn::factory($addOn);
            }
        }

        $this->_attributes['addOns'] = $addOnArray;

        $discountArray = [];

        if (isset($attributes['discounts'])) {
            foreach ($attributes['discounts'] as $discount) {
                $discountArray[] = Discount::factory($discount);
            }
        }

        $this->_attributes['discounts'] = $discountArray;

        $planArray = [];

        if (isset($attributes['plans'])) {
            foreach ($attributes['plans'] as $plan) {
                $planArray[] = self::factory($plan);
            }
        }

        $this->_attributes['plans'] = $planArray;
    }
}
