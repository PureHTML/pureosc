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

namespace Braintree\Transaction;

use Braintree\AchMandate;
use Braintree\Instance;

/**
 * US Bank Account details from a transaction
 * creates an instance of UsbankAccountDetails.
 *
 * @property string $accountHolderName
 * @property string $accountType
 * @property string $achMandate
 * @property string $bankName
 * @property string $imageUrl
 * @property string $last4
 * @property string $routingNumber
 * @property string $token
 */
class UsBankAccountDetails extends Instance
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

        $achMandate = isset($attributes['achMandate']) ?
            AchMandate::factory($attributes['achMandate']) :
            null;
        $this->achMandate = $achMandate;
    }
}
