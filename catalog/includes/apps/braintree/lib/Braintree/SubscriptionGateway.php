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

namespace Braintree;

/**
 * Braintree SubscriptionGateway module.
 *
 * <b>== More information ==</b>
 *
 * For more detailed information on Subscriptions, see {@link https://developers.braintreepayments.com/reference/response/subscription/php https://developers.braintreepayments.com/reference/response/subscription/php}
 */
class SubscriptionGateway
{
    private $_gateway;
    private $_config;
    private $_http;

    public function __construct($gateway)
    {
        $this->_gateway = $gateway;
        $this->_config = $gateway->config;
        $this->_config->assertHasAccessTokenOrKeys();
        $this->_http = new Http($gateway->config);
    }

    public function create($attributes)
    {
        Util::verifyKeys(self::_createSignature(), $attributes);
        $path = $this->_config->merchantPath().'/subscriptions';
        $response = $this->_http->post($path, ['subscription' => $attributes]);

        return $this->_verifyGatewayResponse($response);
    }

    public function find($id)
    {
        $this->_validateId($id);

        try {
            $path = $this->_config->merchantPath().'/subscriptions/'.$id;
            $response = $this->_http->get($path);

            return Subscription::factory($response['subscription']);
        } catch (Exception\NotFound $e) {
            throw new Exception\NotFound('subscription with id '.$id.' not found');
        }
    }

    public function search($query)
    {
        $criteria = [];

        foreach ($query as $term) {
            $criteria[$term->name] = $term->toparam();
        }

        $path = $this->_config->merchantPath().'/subscriptions/advanced_search_ids';
        $response = $this->_http->post($path, ['search' => $criteria]);
        $pager = [
            'object' => $this,
            'method' => 'fetch',
            'methodArgs' => [$query],
        ];

        return new ResourceCollection($response, $pager);
    }

    public function fetch($query, $ids)
    {
        $criteria = [];

        foreach ($query as $term) {
            $criteria[$term->name] = $term->toparam();
        }

        $criteria['ids'] = SubscriptionSearch::ids()->in($ids)->toparam();
        $path = $this->_config->merchantPath().'/subscriptions/advanced_search';
        $response = $this->_http->post($path, ['search' => $criteria]);

        return Util::extractAttributeAsArray(
            $response['subscriptions'],
            'subscription',
        );
    }

    public function update($subscriptionId, $attributes)
    {
        Util::verifyKeys(self::_updateSignature(), $attributes);
        $path = $this->_config->merchantPath().'/subscriptions/'.$subscriptionId;
        $response = $this->_http->put($path, ['subscription' => $attributes]);

        return $this->_verifyGatewayResponse($response);
    }

    public function retryCharge($subscriptionId, $amount = null, $submitForSettlement = false)
    {
        $transaction_params = ['type' => Transaction::SALE,
            'subscriptionId' => $subscriptionId];

        if (isset($amount)) {
            $transaction_params['amount'] = $amount;
        }

        if ($submitForSettlement) {
            $transaction_params['options'] = ['submitForSettlement' => $submitForSettlement];
        }

        $path = $this->_config->merchantPath().'/transactions';
        $response = $this->_http->post($path, ['transaction' => $transaction_params]);

        return $this->_verifyGatewayResponse($response);
    }

    public function cancel($subscriptionId)
    {
        $path = $this->_config->merchantPath().'/subscriptions/'.$subscriptionId.'/cancel';
        $response = $this->_http->put($path);

        return $this->_verifyGatewayResponse($response);
    }

    private static function _createSignature()
    {
        return array_merge(
            [
                'billingDayOfMonth',
                'firstBillingDate',
                'createdAt',
                'updatedAt',
                'id',
                'merchantAccountId',
                'neverExpires',
                'numberOfBillingCycles',
                'paymentMethodToken',
                'paymentMethodNonce',
                'planId',
                'price',
                'trialDuration',
                'trialDurationUnit',
                'trialPeriod',
                ['descriptor' => ['name', 'phone', 'url']],
                ['options' => [
                    'doNotInheritAddOnsOrDiscounts',
                    'startImmediately',
                    ['paypal' => ['description']],
                ]],
            ],
            self::_addOnDiscountSignature(),
        );
    }

    private static function _updateSignature()
    {
        return array_merge(
            [
                'merchantAccountId', 'numberOfBillingCycles', 'paymentMethodToken', 'planId',
                'paymentMethodNonce', 'id', 'neverExpires', 'price',
                ['descriptor' => ['name', 'phone', 'url']],
                ['options' => [
                    'prorateCharges',
                    'replaceAllAddOnsAndDiscounts',
                    'revertSubscriptionOnProrationFailure',
                    ['paypal' => ['description']],
                ]],
            ],
            self::_addOnDiscountSignature(),
        );
    }

    private static function _addOnDiscountSignature()
    {
        return [
            [
                'addOns' => [
                    ['add' => ['amount', 'inheritedFromId', 'neverExpires', 'numberOfBillingCycles', 'quantity']],
                    ['update' => ['amount', 'existingId', 'neverExpires', 'numberOfBillingCycles', 'quantity']],
                    ['remove' => ['_anyKey_']],
                ],
            ],
            [
                'discounts' => [
                    ['add' => ['amount', 'inheritedFromId', 'neverExpires', 'numberOfBillingCycles', 'quantity']],
                    ['update' => ['amount', 'existingId', 'neverExpires', 'numberOfBillingCycles', 'quantity']],
                    ['remove' => ['_anyKey_']],
                ],
            ],
        ];
    }

    /**
     * @ignore
     *
     * @param null|mixed $id
     */
    private function _validateId($id = null): void
    {
        if (empty($id)) {
            throw new \InvalidArgumentException(
                'expected subscription id to be set',
            );
        }

        if (!preg_match('/^[0-9A-Za-z_-]+$/', $id)) {
            throw new \InvalidArgumentException(
                $id.' is an invalid subscription id.',
            );
        }
    }

    /**
     * @ignore
     *
     * @param mixed $response
     */
    private function _verifyGatewayResponse($response)
    {
        if (isset($response['subscription'])) {
            return new Result\Successful(
                Subscription::factory($response['subscription']),
            );
        }

        if (isset($response['transaction'])) {
            // return a populated instance of Transaction, for subscription retryCharge
            return new Result\Successful(
                Transaction::factory($response['transaction']),
            );
        }

        if (isset($response['apiErrorResponse'])) {
            return new Result\Error($response['apiErrorResponse']);
        }

        throw new Exception\Unexpected(
            'Expected subscription, transaction, or apiErrorResponse',
        );
    }
}
