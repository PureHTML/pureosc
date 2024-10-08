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

namespace Braintree\MerchantAccount;

use Braintree\Base;

class BusinessDetails extends Base
{
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }
    protected function _initialize($businessAttribs): void
    {
        $this->_attributes = $businessAttribs;

        if (isset($businessAttribs['address'])) {
            $this->_set('addressDetails', new AddressDetails($businessAttribs['address']));
        }
    }
}
