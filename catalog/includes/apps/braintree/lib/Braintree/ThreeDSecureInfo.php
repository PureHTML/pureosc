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
 * @property string $cavv
 * @property string $dsTransactionId
 * @property string $eciFlag
 * @property string $enrolled
 * @property string $liabilityShifted
 * @property bool   $liabilityShiftPossible
 * @property string $status
 * @property string $threeDSecureVersion
 * @property bool   $xid
 */
class ThreeDSecureInfo extends Base
{
    /**
     * returns a string representation of the three d secure info.
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
