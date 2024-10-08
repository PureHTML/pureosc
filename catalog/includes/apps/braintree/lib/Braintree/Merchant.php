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

namespace Braintree;

class Merchant extends Base
{
    /**
     * returns a string representation of the merchant.
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__.'['.
                Util::attributesToString($this->_attributes).']';
    }

    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }
    protected function _initialize($attribs): void
    {
        $this->_attributes = $attribs;

        $merchantAccountArray = [];

        if (isset($attribs['merchantAccounts'])) {
            foreach ($attribs['merchantAccounts'] as $merchantAccount) {
                $merchantAccountArray[] = MerchantAccount::factory($merchantAccount);
            }
        }

        $this->_set('merchantAccounts', $merchantAccountArray);
    }
}
