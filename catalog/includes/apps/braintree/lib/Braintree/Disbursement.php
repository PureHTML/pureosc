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

class Disbursement extends Base
{
    public const TYPE_CREDIT = 'credit';
    public const TYPE_DEBIT = 'debit';
    private $_merchantAccount;

    public function __toString()
    {
        $display = [
            'id', 'merchantAccountDetails', 'exceptionMessage', 'amount',
            'disbursementDate', 'followUpAction', 'retry', 'success',
            'transactionIds', 'disbursementType',
        ];

        $displayAttributes = [];

        foreach ($display as $attrib) {
            $displayAttributes[$attrib] = $this->{$attrib};
        }

        return __CLASS__.'['.
                Util::attributesToString($displayAttributes).']';
    }

    public function transactions()
    {
        return Transaction::search([
            TransactionSearch::ids()->in($this->transactionIds),
        ]);
    }

    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    public function isDebit()
    {
        return $this->disbursementType === self::TYPE_DEBIT;
    }

    public function isCredit()
    {
        return $this->disbursementType === self::TYPE_CREDIT;
    }

    protected function _initialize($disbursementAttribs): void
    {
        $this->_attributes = $disbursementAttribs;
        $this->merchantAccountDetails = $disbursementAttribs['merchantAccount'];

        if (isset($disbursementAttribs['merchantAccount'])) {
            $this->_set(
                'merchantAccount',
                MerchantAccount::factory($disbursementAttribs['merchantAccount']),
            );
        }
    }
}
