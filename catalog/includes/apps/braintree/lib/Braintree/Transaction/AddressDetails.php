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
 * Creates an instance of AddressDetails as returned from a transaction.
 *
 * @property string $company
 * @property string $countryName
 * @property string $extendedAddress
 * @property string $firstName
 * @property string $lastName
 * @property string $locality
 * @property string $postalCode
 * @property string $region
 * @property string $streetAddress
 */
class AddressDetails extends Instance
{
    protected $_attributes = [];
}
