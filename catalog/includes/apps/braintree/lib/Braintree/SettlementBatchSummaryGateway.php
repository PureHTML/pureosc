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

class SettlementBatchSummaryGateway
{
    private Gateway $_gateway;

    private Configuration $_config;

    private Http $_http;

    /**
     * @param Gateway $gateway
     */
    public function __construct($gateway)
    {
        $this->_gateway = $gateway;
        $this->_config = $gateway->config;
        $this->_config->assertHasAccessTokenOrKeys();
        $this->_http = new Http($gateway->config);
    }

    /**
     * @param string $settlement_date
     * @param string $groupByCustomField
     *
     * @return Result\Error|SettlementBatchSummary
     */
    public function generate($settlement_date, $groupByCustomField = null)
    {
        $criteria = ['settlement_date' => $settlement_date];

        if (isset($groupByCustomField)) {
            $criteria['group_by_custom_field'] = $groupByCustomField;
        }

        $params = ['settlement_batch_summary' => $criteria];
        $path = $this->_config->merchantPath().'/settlement_batch_summary';
        $response = $this->_http->post($path, $params);

        if (isset($groupByCustomField)) {
            $response['settlementBatchSummary']['records'] = $this->_underscoreCustomField(
                $groupByCustomField,
                $response['settlementBatchSummary']['records'],
            );
        }

        return $this->_verifyGatewayResponse($response);
    }

    /**
     * @param string $groupByCustomField
     * @param array  $records
     *
     * @return array
     */
    private function _underscoreCustomField($groupByCustomField, $records)
    {
        $updatedRecords = [];

        foreach ($records as $record) {
            $camelized = Util::delimiterToCamelCase($groupByCustomField);
            $record[$groupByCustomField] = $record[$camelized];
            unset($record[$camelized]);
            $updatedRecords[] = $record;
        }

        return $updatedRecords;
    }

    /**
     * @param array $response
     *
     * @throws Exception\Unexpected
     *
     * @return Result\Error|Result\Successful
     */
    private function _verifyGatewayResponse($response)
    {
        if (isset($response['settlementBatchSummary'])) {
            return new Result\Successful(
                SettlementBatchSummary::factory($response['settlementBatchSummary']),
            );
        }

        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        throw new Exception\Unexpected(
            'Expected settlementBatchSummary or apiErrorResponse',
        );
    }
}
