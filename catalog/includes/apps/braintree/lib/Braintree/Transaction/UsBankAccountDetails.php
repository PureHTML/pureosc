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
