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
 * Braintree LocalPaymentCompleted module.
 *
 * @category   Resources
 */

/**
 * Manages Braintree LocalPaymentCompleted.
 *
 * <b>== More information ==</b>
 *
 * @category   Resources
 *
 * @property string                 $payerId
 * @property string                 $paymentId
 * @property string                 $paymentMethodNonce
 * @property \Braintree\Transaction $transaction
 */
class LocalPaymentCompleted extends Base
{
    /**
     * create a printable representation of the object as:
     * ClassName[property=value, property=value]
     *
     * @return string
     */
    public function __toString()
    {
        return __CLASS__.'['.
                Util::attributesToString($this->_attributes).']';
    }
    /**
     *  factory method: returns an instance of GrantedPaymentInstrumentUpdate
     *  to the requesting method, with populated properties.
     *
     * @ignore
     *
     * @param mixed $attributes
     *
     * @return LocalPaymentCompleted
     */
    public static function factory($attributes)
    {
        $instance = new self();
        $instance->_initialize($attributes);

        return $instance;
    }

    /* instance methods */

    /**
     * sets instance properties from an array of values.
     *
     * @param mixed $localPaymentCompletedAttribs
     */
    protected function _initialize($localPaymentCompletedAttribs): void
    {
        // set the attributes
        $this->_attributes = $localPaymentCompletedAttribs;

        if (isset($transactionAttribs['transaction'])) {
            $this->_set(
                'transaction',
                new Transaction(
                    $transactionAttribs['transaction'],
                ),
            );
        }
    }
}
