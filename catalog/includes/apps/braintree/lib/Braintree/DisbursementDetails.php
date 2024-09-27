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

namespace Braintree;

/**
 * Disbursement details from a transaction
 * Creates an instance of DisbursementDetails as returned from a transaction.
 *
 * @property string $disbursementDate
 * @property bool   $fundsHeld
 * @property string $settlementAmount
 * @property string $settlementCurrencyExchangeRate
 * @property string $settlementCurrencyIsoCode
 * @property string $success
 */
class DisbursementDetails extends Instance
{
    public function isValid()
    {
        return null !== $this->disbursementDate;
    }
}
