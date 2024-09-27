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
 * @property array $records
 */
class SettlementBatchSummary extends Base
{
    /**
     * @param array $attributes
     *
     * @return SettlementBatchSummary
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    public function records()
    {
        return $this->_attributes['records'];
    }

    /**
     * static method redirecting to gateway.
     *
     * @param string $settlement_date    Date YYYY-MM-DD
     * @param string $groupByCustomField
     *
     * @return Result\Error|Result\Successful
     */
    public static function generate($settlement_date, $groupByCustomField = null)
    {
        return Configuration::gateway()->settlementBatchSummary()->generate($settlement_date, $groupByCustomField);
    }

    /**
     * @ignore
     *
     * @param array $attributes
     */
    protected function _initialize($attributes): void
    {
        $this->_attributes = $attributes;
    }
}
