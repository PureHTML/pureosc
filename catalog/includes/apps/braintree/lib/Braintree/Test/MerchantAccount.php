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

namespace Braintree\Test;

/**
 * Merchant Account constants used for testing purposes.
 */
class MerchantAccount
{
    public static $approve = 'approve_me';
    public static $insufficientFundsContactUs = 'insufficient_funds__contact';
    public static $accountNotAuthorizedContactUs = 'account_not_authorized__contact';
    public static $bankRejectedUpdateFundingInformation = 'bank_rejected__update';
    public static $bankRejectedNone = 'bank_rejected__none';
}
