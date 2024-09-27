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
 * Creates an instance of AuthorizationAdjustment as returned from a transaction.
 *
 * @property string    $amount
 * @property bool      $success
 * @property \DateTime $timestamp
 */
class AuthorizationAdjustment extends Base
{
    public function __toString()
    {
        return __CLASS__.'['.Util::attributesToString($this->_attributes).']';
    }
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    protected function _initialize($authorizationAdjustmentAttribs): void
    {
        $this->_attributes = $authorizationAdjustmentAttribs;
    }
}
