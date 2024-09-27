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
 * Line item associated with a transaction.
 */

/**
 * creates an instance of TransactionLineItem.
 *
 * @property string $commodityCode
 * @property string $description
 * @property string $discountAmount
 * @property string $kind
 * @property string $name
 * @property string $productCode
 * @property string $quantity
 * @property string $taxAmount
 * @property string $totalAmount
 * @property string $unitAmount
 * @property string $unitOfMeasure
 * @property string $unitTaxAmount
 * @property string $url
 */
class TransactionLineItem extends Instance
{
    // TransactionLineItem Kinds
    public const CREDIT = 'credit';
    public const DEBIT = 'debit';
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

    public static function findAll($transactionId)
    {
        return Configuration::gateway()->transactionLineItem()->findAll($transactionId);
    }
}
