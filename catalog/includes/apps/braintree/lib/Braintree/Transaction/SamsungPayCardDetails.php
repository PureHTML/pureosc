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
 * SamsungPayCard details from a transaction
 * creates an instance of SamsungPayCardDetails.
 *
 * @property string $bin
 * @property string $cardholderName
 * @property string $cardType
 * @property string $commercial
 * @property string $countryOfIssuance
 * @property string $customerId
 * @property string $customerLocation
 * @property string $debit
 * @property string $durbinRegulated
 * @property string $expirationDate
 * @property string $expirationMonth
 * @property string $expirationYear
 * @property string $healthcare
 * @property string $imageUrl
 * @property string $issuingBank
 * @property string $last4
 * @property string $maskedNumber
 * @property string $payroll
 * @property string $prepaid
 * @property string $productId
 * @property string $sourceCardLast4
 * @property string $token
 * @property string $updatedAt
 */
class SamsungPayCardDetails extends Instance
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
        $this->_attributes['expirationDate'] = $this->expirationMonth.'/'.$this->expirationYear;
        $this->_attributes['maskedNumber'] = $this->bin.'******'.$this->last4;
    }
}
