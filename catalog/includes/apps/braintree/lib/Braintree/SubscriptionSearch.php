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

class SubscriptionSearch
{
    public static function billingCyclesRemaining()
    {
        return new RangeNode('billing_cycles_remaining');
    }

    public static function daysPastDue()
    {
        return new RangeNode('days_past_due');
    }

    public static function id()
    {
        return new TextNode('id');
    }

    public static function inTrialPeriod()
    {
        return new MultipleValueNode('in_trial_period', [true, false]);
    }

    public static function merchantAccountId()
    {
        return new MultipleValueNode('merchant_account_id');
    }

    public static function nextBillingDate()
    {
        return new RangeNode('next_billing_date');
    }

    public static function planId()
    {
        return new MultipleValueOrTextNode('plan_id');
    }

    public static function price()
    {
        return new RangeNode('price');
    }

    public static function status()
    {
        return new MultipleValueNode('status', [
            Subscription::ACTIVE,
            Subscription::CANCELED,
            Subscription::EXPIRED,
            Subscription::PAST_DUE,
            Subscription::PENDING,
        ]);
    }

    public static function transactionId()
    {
        return new TextNode('transaction_id');
    }

    public static function ids()
    {
        return new MultipleValueNode('ids');
    }

    public static function createdAt()
    {
        return new RangeNode('created_at');
    }
}
