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
