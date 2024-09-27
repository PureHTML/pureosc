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
