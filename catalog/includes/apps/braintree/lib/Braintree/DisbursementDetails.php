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
