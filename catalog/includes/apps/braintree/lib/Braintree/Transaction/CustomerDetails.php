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
 * Customer details from a transaction
 * Creates an instance of customer details as returned from a transaction.
 *
 * @property string $company
 * @property string $email
 * @property string $fax
 * @property string $firstName
 * @property string $id
 * @property string $lastName
 * @property string $phone
 * @property string $website
 */
class CustomerDetails extends Instance
{
}
