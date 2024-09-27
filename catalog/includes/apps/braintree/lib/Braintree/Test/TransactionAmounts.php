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

namespace Braintree\Test;

/**
 * Transaction amounts used for testing purposes.
 *
 * The constants in this class can be used to create transactions with
 * the desired status in the sandbox environment.
 */
class TransactionAmounts
{
    public static $authorize = '1000.00';
    public static $decline = '2000.00';
    public static $hardDecline = '2015.00';
}
