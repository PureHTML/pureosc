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
