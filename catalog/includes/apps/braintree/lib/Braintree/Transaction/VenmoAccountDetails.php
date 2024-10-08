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
