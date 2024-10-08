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
 * Braintree Subscription module.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on Subscriptions, see {@link https://developers.braintreepayments.com/reference/response/subscription/php https://developers.braintreepayments.com/reference/response/subscription/php}
 *
 * @property \Braintree\Addon[]                      $addOns
 * @property string                                  $balance
 * @property int                                     $billingDayOfMonth
 * @property \DateTime                               $billingPeriodEndDate
 * @property \DateTime                               $billingPeriodStartDate
 * @property \DateTime                               $createdAt
 * @property int                                     $currentBillingCycle
 * @property null|int                                $daysPastDue
 * @property null|string                             $description
 * @property null|\Braintree\Descriptor              $descriptor
 * @property \Braintree\Discount[]                   $discounts
 * @property int                                     $failureCount
 * @property \DateTime                               $firstBillingDate
 * @property string                                  $id
 * @property string                                  $merchantAccountId
 * @property bool                                    $neverExpires
 * @property \DateTime                               $nextBillingDate
 * @property string                                  $nextBillingPeriodAmount
 * @property null|int                                $numberOfBillingCycles
 * @property null|\DateTime                          $paidThroughDate
 * @property string                                  $paymentMethodToken
 * @property string                                  $planId
 * @property string                                  $price
 * @property string                                  $status
 * @property \Braintree\Subscription\StatusDetails[] $statusHistory
 * @property \Braintree\Transaction[]                $transactions
 * @property int                                     $trialDuration
 * @property string                                  $trialDurationUnit
 * @property bool                                    $trialPeriod
 * @property \DateTime                               $updatedAt
 */
class Subscription extends Base
{
    public const ACTIVE = 'Active';
    public const CANCELED = 'Canceled';
    public const EXPIRED = 'Expired';
    public const PAST_DUE = 'Past Due';
    public const PENDING = 'Pending';

    // Subscription Sources
    public const API = 'api';
    public const CONTROL_PANEL = 'control_panel';
    public const RECURRING = 'recurring';

    /**
     * returns a string representation of the customer.
     *
     * @return string
     */
    public function __toString()
    {
        $excludedAttributes = ['statusHistory'];

        $displayAttributes = [];

        foreach ($this->_attributes as $key => $val) {
            if (!\in_array($key, $excludedAttributes, true)) {
                $displayAttributes[$key] = $val;
            }
        }

        return __CLASS__.'['.
                Util::attributesToString($displayAttributes).']';
    }

    /**
     * @ignore
     *
     * @param mixed $attributes
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    // static methods redirecting to gateway

    public static function create($attributes)
    {
        return Configuration::gateway()->subscription()->create($attributes);
    }

    public static function find($id)
    {
        return Configuration::gateway()->subscription()->find($id);
    }

    public static function search($query)
    {
        return Configuration::gateway()->subscription()->search($query);
    }

    public static function fetch($query, $ids)
    {
        return Configuration::gateway()->subscription()->fetch($query, $ids);
    }

    public static function update($subscriptionId, $attributes)
    {
        return Configuration::gateway()->subscription()->update($subscriptionId, $attributes);
    }

    public static function retryCharge($subscriptionId, $amount = null, $submitForSettlement = false)
    {
        return Configuration::gateway()->subscription()->retryCharge($subscriptionId, $amount, $submitForSettlement);
    }

    public static function cancel($subscriptionId)
    {
        return Configuration::gateway()->subscription()->cancel($subscriptionId);
    }

    /**
     * @ignore
     *
     * @param mixed $attributes
     */
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

        if (isset($attributes['descriptor'])) {
            $this->_set('descriptor', new Descriptor($attributes['descriptor']));
        }

        if (isset($attributes['description'])) {
            $this->_set('description', $attributes['description']);
        }

        $statusHistory = [];

        if (isset($attributes['statusHistory'])) {
            foreach ($attributes['statusHistory'] as $history) {
                $statusHistory[] = new Subscription\StatusDetails($history);
            }
        }

        $this->_attributes['statusHistory'] = $statusHistory;

        $transactionArray = [];

        if (isset($attributes['transactions'])) {
            foreach ($attributes['transactions'] as $transaction) {
                $transactionArray[] = Transaction::factory($transaction);
            }
        }

        $this->_attributes['transactions'] = $transactionArray;
    }
}
