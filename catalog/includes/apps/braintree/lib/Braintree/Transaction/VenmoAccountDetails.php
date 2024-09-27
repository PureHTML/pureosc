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
 * Venmo account details from a transaction.
 */

/**
 * creates an instance of VenmoAccountDetails.
 *
 * @property string $imageUrl
 * @property string $sourceDescription
 * @property string $token
 * @property string $username
 * @property string $venmo_user_id
 *
 * @uses Instance inherits methods
 */
class VenmoAccountDetails extends Instance
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
