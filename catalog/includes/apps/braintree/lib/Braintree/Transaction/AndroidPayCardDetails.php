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

namespace Braintree\Transaction;

use Braintree\Instance;

/**
 * Android Pay card details from a transaction.
 */

/**
 * creates an instance of AndroidPayCardDetails.
 *
 * @property string $bin
 * @property string $commercial
 * @property string $countryOfIssuance
 * @property string $debit
 * @property string $default
 * @property string $durbinRegulated
 * @property string $expirationMonth
 * @property string $expirationYear
 * @property string $googleTransactionId
 * @property string $healthcare
 * @property string $imageUrl
 * @property bool   $isNetworkTokenized
 * @property string $issuingBank
 * @property string $payroll
 * @property string $prepaid
 * @property string $productId
 * @property string $sourceCardLast4
 * @property string $sourceCardType
 * @property string $sourceDescription
 * @property string $token
 * @property string $virtualCardLast4
 * @property string $virtualCardType
 */
class AndroidPayCardDetails extends Instance
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
        $this->_attributes['cardType'] = $this->virtualCardType;
        $this->_attributes['last4'] = $this->virtualCardLast4;
    }
}
