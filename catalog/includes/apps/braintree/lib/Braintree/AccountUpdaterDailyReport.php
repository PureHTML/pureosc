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
 * Creates an instance of AccountUpdaterDailyReport.
 *
 * @property date   $reportDate
 * @property string $reportUrl
 */
class AccountUpdaterDailyReport extends Base
{
    protected $_attributes = [];

    public function __toString()
    {
        $display = [
            'reportDate', 'reportUrl',
        ];

        $displayAttributes = [];

        foreach ($display as $attrib) {
            $displayAttributes[$attrib] = $this->{$attrib};
        }

        return __CLASS__.'['.
                Util::attributesToString($displayAttributes).']';
    }

    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    protected function _initialize($disputeAttribs): void
    {
        $this->_attributes = $disputeAttribs;
    }
}
