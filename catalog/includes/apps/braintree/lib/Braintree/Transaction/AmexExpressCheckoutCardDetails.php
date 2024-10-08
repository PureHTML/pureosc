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
 * Amex Express Checkout card details from a transaction.
 *
 * @deprecated
 */

/**
 * creates an instance of AmexExpressCheckoutCardDetails.
 *
 * @deprecated
 *
 * @property string $bin
 * @property string $cardMemberExpiryDate
 * @property string $cardMemberNumber
 * @property string $cardType
 * @property string $expirationMonth
 * @property string $expirationYear
 * @property string $imageUrl
 * @property string $sourceDescription
 * @property string $token
 *
 * @uses Instance inherits methods
 */
class AmexExpressCheckoutCardDetails extends Instance
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
