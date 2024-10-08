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
