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

namespace Braintree\MerchantAccount;

use Braintree\Base;

class IndividualDetails extends Base
{
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }
    protected function _initialize($individualAttribs): void
    {
        $this->_attributes = $individualAttribs;

        if (isset($individualAttribs['address'])) {
            $this->_set('addressDetails', new AddressDetails($individualAttribs['address']));
        }
    }
}
