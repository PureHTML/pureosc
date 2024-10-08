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
 * PayPal details from a transaction.
 */

/**
 * creates an instance of PayPalDetails.
 *
 * @property string $authorizationId
 * @property string $billingAgreementId
 * @property string $captureId
 * @property string $customField
 * @property string $description
 * @property string $imageUrl
 * @property string $implicitlyVaultedPaymentMethodGlobalId
 * @property string $implicitlyVaultedPaymentMethodToken
 * @property string $payerEmail
 * @property string $payerFirstName
 * @property string $payerId
 * @property string $payerLastName
 * @property string $payerStatus
 * @property string $paymentId
 * @property string $refundFromTransactionFeeAmount
 * @property string $refundFromTransactionFeeCurrencyIsoCode
 * @property string $refundId
 * @property string $sellerProtectionStatus
 * @property string $taxId
 * @property string $taxIdType
 * @property string $token
 * @property string $transactionFeeAmount
 * @property string $transactionFeeCurrencyIsoCode
 */
class PayPalDetails extends Instance
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
