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
 * Apple Pay card details from a transaction.
 */

/**
 * creates an instance of ApplePayCardDetails.
 *
 * @property string $bin
 * @property string $cardholderName
 * @property string $cardType
 * @property string $commercial
 * @property string $country_of_issuance
 * @property string $debit
 * @property string $durbin_regulated
 * @property string $expirationMonth
 * @property string $expirationYear
 * @property string $healthcare
 * @property string $issuing_bank
 * @property string $paymentInstrumentName
 * @property string $payroll
 * @property string $prepaid
 * @property string $product_id
 * @property string $sourceDescription
 */
class ApplePayCardDetails extends Instance
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
