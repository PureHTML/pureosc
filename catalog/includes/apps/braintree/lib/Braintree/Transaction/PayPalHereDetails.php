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
 * PayPal Here details from a transaction.
 */

/**
 * creates and instance of PayPalHereDetails.
 *
 * @property string $authorizationId
 * @property string $captureId
 * @property string $invoiceId
 * @property string $last4
 * @property string $payment_type
 * @property string $paymentId
 * @property string $refundId
 * @property string $transactionFeeAmount
 * @property string $transactionFeeCurrencyIsoCode
 * @property string $transactionInitiationDate
 * @property string $transactionUpdatedDate
 */
class PayPalHereDetails extends Instance
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
