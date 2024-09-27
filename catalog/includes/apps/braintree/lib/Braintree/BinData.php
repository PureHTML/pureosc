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

/**
 * @property string $commercial
 * @property string $countryOfIssuance
 * @property string $debit
 * @property string $durbinRegulated
 * @property string $healthcare
 * @property string $issuingBank
 * @property string $payroll
 * @property string $prepaid
 * @property string $productId
 */
class BinData extends Base
{
    /**
     * returns a string representation of the bin data.
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

    protected function _initialize($attributes): void
    {
        $this->_attributes = $attributes;
    }
}
