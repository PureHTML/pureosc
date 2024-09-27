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

namespace Braintree\Result;

use Braintree\Base;
use Braintree\Error\ErrorCollection;
use Braintree\MerchantAccount;
use Braintree\Subscription;
use Braintree\Transaction;
use Braintree\Util;

/**
 * Braintree Error Result.
 *
 * An Error Result will be returned from gateway methods when
 * the gateway responds with an error. It will provide access
 * to the original request.
 * For example, when voiding a transaction, Error Result will
 * respond to the void request if it failed:
 *
 * <code>
 * $result = Transaction::void('abc123');
 * if ($result->success) {
 *     // Successful Result
 * } else {
 *     // Result\Error
 * }
 * </code>
 *
 * @property \Braintree\Result\CreditCardVerification $creditCardVerification credit card verification data
 * @property \Braintree\Error\ErrorCollection         $errors
 * @property array                                    $params                 original passed params
 */
class Error extends Base
{
    /**
     * @var bool always false
     */
    public bool $success = false;

    /**
     * overrides default constructor.
     *
     * @ignore
     *
     * @param array $response gateway response array
     */
    public function __construct($response)
    {
        $this->_attributes = $response;
        $this->_set('errors', new ErrorCollection($response['errors']));

        if (isset($response['verification'])) {
            $this->_set('creditCardVerification', new CreditCardVerification($response['verification']));
        } else {
            $this->_set('creditCardVerification', null);
        }

        if (isset($response['transaction'])) {
            $this->_set('transaction', Transaction::factory($response['transaction']));
        } else {
            $this->_set('transaction', null);
        }

        if (isset($response['subscription'])) {
            $this->_set('subscription', Subscription::factory($response['subscription']));
        } else {
            $this->_set('subscription', null);
        }

        if (isset($response['merchantAccount'])) {
            $this->_set('merchantAccount', MerchantAccount::factory($response['merchantAccount']));
        } else {
            $this->_set('merchantAccount', null);
        }

        if (isset($response['verification'])) {
            $this->_set('verification', new CreditCardVerification($response['verification']));
        } else {
            $this->_set('verification', null);
        }
    }

    /**
     * create a printable representation of the object as:
     * ClassName[property=value, property=value]
     *
     * @ignore
     *
     * @return string
     */
    public function __toString()
    {
        $output = Util::attributesToString($this->_attributes);

        if (isset($this->_creditCardVerification)) {
            $output .= sprintf('%s', $this->_creditCardVerification);
        }

        return __CLASS__.'['.$output.']';
    }

    /**
     * return original value for a field
     * For example, if a user tried to submit 'invalid-email' in the html field transaction[customer][email],
     * $result->valueForHtmlField("transaction[customer][email]") would yield "invalid-email".
     *
     * @param string $field
     *
     * @return string
     */
    public function valueForHtmlField($field)
    {
        $pieces = preg_split('/[\\[\\]]+/', $field, 0, \PREG_SPLIT_NO_EMPTY);
        $params = $this->params;

        foreach (\array_slice($pieces, 0, -1) as $key) {
            $params = $params[Util::delimiterToCamelCase($key)];
        }

        if ($key !== 'custom_fields') {
            $finalKey = Util::delimiterToCamelCase(end($pieces));
        } else {
            $finalKey = end($pieces);
        }

        return $params[$finalKey] ?? null;
    }
}
