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

namespace Braintree\Transaction;

use Braintree\Instance;

/**
 * Status details from a transaction
 * Creates an instance of StatusDetails, as part of a transaction response.
 *
 * @property string    $amount
 * @property string    $status
 * @property \DateTime $timestamp
 * @property string    $transactionSource
 * @property string    $user
 */
class StatusDetails extends Instance
{
}
