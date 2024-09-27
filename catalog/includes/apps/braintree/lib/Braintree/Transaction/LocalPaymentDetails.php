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
 * Local payment details from a transaction.
 */

/**
 * creates an instance of LocalPaymentDetails.
 *
 * @property string $captureId
 * @property string $customField
 * @property string $debugId
 * @property string $description
 * @property string $fundingSource
 * @property string $payerId
 * @property string $paymentId
 * @property string $refundFromTransactionFeeAmount
 * @property string $refundFromTransactionFeeCurrencyIsoCode
 * @property string $refundId
 * @property string $transactionFeeAmount
 * @property string $transactionFeeCurrencyIsoCode
 */
class LocalPaymentDetails extends Instance
{
    protected $_attributes = [];

    /**
     * @ignore
     *
     * @param mixed $attributes
     */
    public function __construct($attributes)
    {
        parent::__construct($attributes);
    }
}
