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

namespace Braintree\Test;

use Braintree\Configuration;

/**
 * Transaction amounts used for testing purposes.
 *
 * The constants in this class can be used to create transactions with
 * the desired status in the sandbox environment.
 */
class Transaction
{
    /**
     * settle a transaction by id in sandbox.
     *
     * @param mixed $transactionId
     *
     * @return Transaction
     */
    public static function settle($transactionId)
    {
        return Configuration::gateway()->testing()->settle($transactionId);
    }

    /**
     * settlement confirm a transaction by id in sandbox.
     *
     * @param mixed $transactionId
     *
     * @return Transaction
     */
    public static function settlementConfirm($transactionId)
    {
        return Configuration::gateway()->testing()->settlementConfirm($transactionId);
    }

    /**
     * settlement decline a transaction by id in sandbox.
     *
     * @param mixed $transactionId
     *
     * @return Transaction
     */
    public static function settlementDecline($transactionId)
    {
        return Configuration::gateway()->testing()->settlementDecline($transactionId);
    }

    /**
     * settlement pending a transaction by id in sandbox.
     *
     * @param mixed $transactionId
     *
     * @return Transaction
     */
    public static function settlementPending($transactionId)
    {
        return Configuration::gateway()->testing()->settlementPending($transactionId);
    }
}
