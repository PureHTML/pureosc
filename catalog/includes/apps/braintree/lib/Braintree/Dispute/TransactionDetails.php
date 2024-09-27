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

namespace Braintree\Dispute;

use Braintree\Instance;

/**
 * Transaction details for a dispute.
 *
 * @property string    $amount
 * @property \DateTime $createdAt
 * @property string    $id
 * @property int       $installmentCount
 * @property string    $orderId
 * @property string    $paymentInstrumentSubtype
 * @property string    $purchaseOrderNumber
 */

/**
 * Creates an instance of DisbursementDetails as returned from a transaction.
 *
 * @property string $amount
 * @property string $id
 */
class TransactionDetails extends Instance
{
}
